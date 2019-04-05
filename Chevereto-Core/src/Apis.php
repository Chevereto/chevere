<?php

declare(strict_types=1);
/*
 * This file is part of Chevereto\Core.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chevereto\Core;

use Exception;
use ReflectionParameter;
use ReflectionMethod;
use RuntimeException;
use RecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class Apis
{
    /** @var Router */
    protected $router;
    /** @var array ['api-key' => [<endpoint> => [<options>]]] */
    protected $apis = [];
    /** @var array ['api-key' => [<options>]] */
    protected $bases = [];
    /** @var array ['/api-key/v1/endpoint' => ['api-key', 'v1/endpoint']] */
    protected $routeKeys = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Automatically finds controllers in the given path and generate the API route binding.
     *
     * @param string $basename       API basename ('api')
     * @param string $pathIdentifier path identifier representing the dir containing API controllers (relative to app)
     */
    public function register(string $basename, string $pathIdentifier): self
    {
        try {
            if (isset($this->apis[$pathIdentifier])) {
                throw new CoreException(
                    (new Message('Path identified by %s has been already bound'))
                        ->code('%s', $pathIdentifier)
                );
            }
            $directory = Path::fromHandle($pathIdentifier);
            if (!File::exists($directory)) {
                throw new CoreException(
                    (new Message("Directory %s doesn't exists."))
                        ->code('%s', $directory)
                    );
            }
            $relativeDirectory = Path::relative($directory, App::APP);
        } catch (Exception $e) {
            throw new ApiException($e);
        }
        // $ROUTE_MAP = [route? => [<http method> => <callable relative to app>]]]
        $ROUTE_MAP = [];
        // $OPTIONS = [<callable relative to app> => OPTIONS]
        $OPTIONS = [];
        // Public exposed API
        $API = [];
        // Wildcards from resource.json
        $RESOURCE_WILDCARDS = [];
        try {
            $directoryIterator = new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS);
            $recursiveIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
        $errors = [];
        $pop = [];
        $resource = null;
        // Iterate over all the files in the target API directory, fills $RESOURCE_WILDCARDS
        foreach ($recursiveIterator as $filename) {
            // TODO: Tiene que leer / (api:GET, api:resource.json)
            $filePath = (string) $filename;
            $filePath = Utils\Str::forwardSlashes($filePath);
            // app/api/endpoint/VERB.php (used in error messages)
            $filePathRelative = Path::relative($filePath);
            // api/endpoint/VERB.php
            $filePathRelativeApp = Path::relative($filePath, App::APP);
            $dir = Utils\Str::replaceFirst($directory, null, $filePath);
            // Dirs = resources & version
            // Files = closure controllers
            if ($filename->isDir()) {
                /**
                 * resource.json contains the properties descriptions for the __invoke
                 * object-hinted arguments _invoke(User $user) ($user = user = the resource).
                 */
                $resourceFilePath = $filePath.'/resource.json';
                if (File::exists($resourceFilePath)) {
                    $jsonResource = file_get_contents($resourceFilePath);
                    if (false !== $jsonResource) {
                        $jsonResource = json_decode($jsonResource);
                    }
                    if (isset($jsonResource) && isset($jsonResource->wildcards)) {
                        $resourceWildcards = [];
                        foreach ($jsonResource->wildcards as $k => $v) {
                            $resourceWildcards[$k] = new RouteWildcard($v->description ?? null, $v->regex ?? null);
                        }
                    }
                    $RESOURCE_WILDCARDS[$dir] = $resourceWildcards ?? [];
                } else {
                    $RESOURCE_WILDCARDS[$dir] = $RESOURCE_WILDCARDS[dirname($dir)] ?? [];
                }
            } else {
                $httpVerb = basename($dir, '.php');
                // Only valid HTTP request methods allowed, ignore the rest
                if (!in_array($httpVerb, Route::HTTP_METHODS)) {
                    continue;
                }
                $dir = dirname($dir); // /endpoint
                $realDir = $relativeDirectory.$dir; // /api/endpoint
                $controller = include $filePath;
                // Don't mind about these
                if (!$controller instanceof Controller) {
                    continue;
                }
                // Determine required {wildcards??} needed for Route
                $invoke = new ReflectionMethod($controller, '__invoke');
                // Store options
                $OPTIONS[$filePathRelativeApp] = defined(get_class($controller).'::OPTIONS') ? $controller::OPTIONS : null;
                $paramCount = $invoke->getNumberOfParameters();
                $explode = explode('/', $dir);
                $explodeCount = count($explode);
                if ($paramCount > $explodeCount) {
                    $errors[] = (new Message('You can only declare %n invoke method argument(s) for API endpoint %e at %f.'))
                        ->code('%n', $explodeCount)
                        ->code('%e', "$httpVerb:$realDir")
                        ->code('%f', $filePathRelative);
                    continue;
                }
                $requiredCnt = $explodeCount - 1;
                if ($requiredCnt > $paramCount) {
                    $errors[] = (new Message('Expecting %n invoke method argument(s), %s provided for API endpoint %e at %f.'))
                        ->code('%n', $requiredCnt)
                        ->code('%s', $paramCount)
                        ->code('%e', "$httpVerb:$realDir")
                        ->code('%f', $filePathRelative);
                    continue;
                }
                // Params have been declared
                if ($paramCount > 0) {
                    $counter = 0;
                    $requiredCntAux = 0;
                    $wildcardsRequire = []; // declared wildcards ['wildcard' => (bool) required]
                    $wildcards = []; // index for of $wildcardsRequire
                    // level - 1 => required params
                    // ie: user/friends = level 2 => required params = 1 = user/{param}/friends
                    foreach ($invoke->getParameters() as $k => $param) {
                        ++$counter;
                        $error = null;
                        $required = ($param->isOptional() || !$param->isDefaultValueAvailable());
                        if ($required) {
                            ++$requiredCntAux;
                        }
                        $mustBeRequired = $counter <= $requiredCnt;
                        if ($mustBeRequired && !$required) {
                            $errors[] = (new Message('Parameter %s must not be declared with a default value for API endpoint %e at %f.'))
                                ->code('%s', '$'.$param->getName())
                                ->code('%e', "$httpVerb:$realDir")
                                ->code('%f', $filePathRelative);
                            continue;
                        }
                        $getType = $param->hasType() ? $param->getType() : null;
                        $type = $getType != null ? $getType->getName() : null;
                        // $type null means no declaration in __invoke, don't mind about it
                        if ($type) {
                            if (in_array($type, Controller::TYPE_DECLARATIONS)) {
                                continue;
                            }
                            $error = static::getInvokeHintError($filePath, $type, $invoke, $param);
                            if (isset($error)) {
                                $errors[] = $error;
                                continue;
                            }
                        }
                        if (!isset($RESOURCE_WILDCARDS[$dir][$param->name])) {
                            // Fill unexistant resource in resource.json
                            $RESOURCE_WILDCARDS[$dir][$param->name] = new RouteWildcard();
                        }
                        $wildcardsRequire[$param->name] = $required ?: false;
                        $wildcards[] = $param->name;
                    } // foreach $params
                    if ($requiredCntAux < $requiredCnt) {
                        $errors[] = (new Message('You must pass %n non-default argument(s) for API endpoint %e at %f.'))
                            ->code('%f', $filePathRelative)
                            ->code('%e', "$httpVerb:$realDir")
                            ->code('%n', $requiredCnt);
                        continue;
                    }
                    // Turn $dir (users/friends) into $endpoint (users/{wildcard}/friends) based on controller _invoke parameters
                    $endpointComp = [];
                    foreach ($explode as $k => $v) {
                        $endpointComp[] = $v;
                        $wildcard = $wildcards[$k] ?? null;
                        if ($wildcard) {
                            $wildcardRoute = '{'.$wildcard.'}';
                            $iLastWildcard = $k == $explodeCount - 1;
                            $iOptional = $wildcardsRequire[$wildcard] == false;
                            if ($iLastWildcard && $iOptional) {
                                // Append last optional wildcard as {wildcard}
                                $endpointComp[] = $wildcardRoute;
                                // Store "required" version
                                $ROUTE_MAP[implode('/', $endpointComp)][$httpVerb] = $filePathRelativeApp;
                                // Remove "required", allows to store "optional" version
                                array_pop($endpointComp);
                            } else {
                                $endpointComp[] = $wildcardRoute;
                            }
                        }
                    }
                    $endpoint = implode('/', $endpointComp);
                } else {
                    // plain _invoke(), runs only on top level
                    $endpoint = $dir;
                }
                $ROUTE_MAP[$endpoint][$httpVerb] = $filePathRelativeApp;
            }
        } // foreach filename
        if ($errors) {
            throw new ApiException(implode("\n", $errors));
        }
        ksort($ROUTE_MAP);
        // dd($ROUTE_MAP);
        // $ROUTE_MAP defines API routing
        foreach ($ROUTE_MAP as $endpoint => $httpMethods) {
            $api = [];
            if ($httpMethods == null) {
                continue;
            }
            $replaced = preg_replace(Route::REGEX_WILDCARD_SEARCH, '', $endpoint);
            $dirRoute = $replaced != null ? Path::normalize($replaced) : null;
            $resourceWildcards = $RESOURCE_WILDCARDS[$dirRoute] ?? [];
            $endpointRoute = Path::normalize('/'.$basename.'/'.$endpoint);
            $explode = explode('/', $endpoint);
            $endsWithWildcard = preg_match(Route::REGEX_WILDCARD_SEARCH, (string) end($explode), $matches) > 0;
            // Set Options => <http method>,
            foreach ($httpMethods as $httpMethod => $controllerFilePath) {
                $options = $OPTIONS[$controllerFilePath];
                $api['OPTIONS'][$httpMethod] = $options[$endsWithWildcard ? '*' : '/'] ?? $options;
            }
            // Autofill OPTIONS and HEAD
            foreach ([
                'OPTIONS' => [Controllers\ApiOptions::class, Controllers\ApiOptions::OPTIONS],
                'HEAD' => [Controllers\ApiHead::class, Controllers\ApiHead::OPTIONS],
            ] as $k => $v) {
                if (!isset($httpMethods[$k])) {
                    $httpMethods[$k] = $v[0];
                    $api['OPTIONS'][$k] = $v[1];
                }
            }
            // dd($httpMethods);
            $route = Route::bind($endpointRoute)->methods($httpMethods)->setId($endpoint);
            $this->routeKeys[$endpointRoute] = [$basename, $endpoint];
            // Define Route wildcard "where" if needed
            if ($route->hasWildcards()) {
                $routeWildcards = $route->getWildcards();
                $filtered = Utils\Arr::filterArray($resourceWildcards, $routeWildcards);
                foreach ($filtered as $wildcardName => $wildcard) {
                    $regex = $wildcard->regex();
                    if (isset($regex)) {
                        $route->where($wildcardName, $regex);
                    }
                }
                $usable = array_map(function (RouteWildcard $wildcard) {
                    return $wildcard->toArray();
                }, $filtered);
                // Define API wildcards from $routeWildcards
                $api['wildcards'] = $usable;
            }
            $this->getRouter()->addRoute($route, $basename);
            $API[$endpoint] = $api;
        }
        ksort($API);

        // dd($this->getRouter()->getRoutes());

        $route = Route::bind('/'.$basename)
            ->method('HEAD', Controllers\ApiHead::class)
            ->method('OPTIONS', Controllers\ApiOptions::class)
            ->method('GET', Controllers\ApiGet::class)
            ->setId($basename);
        $this->getRouter()->addRoute($route, $basename);
        $this->apis[$basename] = $API;
        $baseOpts = [
            'HEAD' => Controllers\ApiHead::OPTIONS,
            'OPTIONS' => Controllers\ApiOptions::OPTIONS,
            'GET' => Controllers\ApiGet::OPTIONS,
        ];
        $this->bases[$basename] = ['OPTIONS' => $baseOpts];
        $this->routeKeys['/'.$basename] = [$basename];

        return $this;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getKeys(): array
    {
        return array_keys($this->apis);
    }

    public function getBaseOptions(string $key): ?array
    {
        return $this->bases[ltrim($key, '/')] ?? null;
    }

    public function getEndpoint(string $key): ?array
    {
        $keys = $this->routeKeys[$key] ?? null;
        if (isset($keys)) {
            $api = $this->get($keys[0]);
            if (isset($keys[1])) {
                return $api[$keys[1]];
            } else {
                return $api ?? null;
            }
        } else {
            return null;
        }
    }

    /**
     * Gets the API key of the alleged endpoint key.
     */
    public function getEndpointApiKey(string $key): ?string
    {
        $keys = $this->routeKeys[$key] ?? null;
        if (isset($keys)) {
            return $keys[0];
        }

        return null;
    }

    /**
     * Get an API.
     *
     * @param string $key the API key (path identifier)
     */
    public function get(string $key = 'api'): ?array
    {
        return $this->apis[$key] ?? null;
    }

    public function getRouteKeys(): ?array
    {
        return $this->routeKeys ?? null;
    }

    /**
     * Get the error associated with invalid controller __invoke(Class $hint).
     */
    protected static function getInvokeHintError(string $filename, string $class = null, ReflectionMethod $invoke, ReflectionParameter $param): ?string
    {
        if (null === $class || !class_exists($class)) {
            $error = 'Class <code>%c</code> doesn\'t exist or it hasn\'t being loaded, the system is unable to resolve implicit <code>%v</code> binding in <code>%f:%l:%n</code>';
        } elseif (!method_exists($class, '__construct')) {
            $error = 'Unable to typehint object <code>%c</code> (no constructor defined)';
        }

        return isset($error) ? strtr($error, [
            '%n' => ($param->getPosition() + 1),
            '%l' => $invoke->getStartLine(),
            '%v' => '$'.$param->name,
            '%c' => $class,
            '%f' => $filename,
        ]) : null;
    }
}
class ApiException extends CoreException
{
}
