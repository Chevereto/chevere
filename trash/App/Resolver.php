<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\Components\App;

use Chevere\Components\App\Exceptions\ResolverException;
use Chevere\Components\App\Interfaces\BuilderInterface;
use Chevere\Components\App\Interfaces\ResolvableInterface;
use Chevere\Components\App\Interfaces\ResolverInterface;
use Chevere\Components\Http\Exceptions\MethodNotFoundException;
use Chevere\Components\Http\Method;
use Chevere\Components\Router\Exceptions\RouteNotFoundException;

/**
 * Resolves a builder against routing
 */
final class Resolver implements ResolverInterface
{
    private BuilderInterface $builder;

    /**
     * @throws ResolverException if the request can't be routed
     */
    public function __construct(ResolvableInterface $resolvable)
    {
        $this->builder = $resolvable->builder();
        $app = $this->builder->build()->app();
        try {
            $routed = $app->services()->router()->resolve(
                $app->request()->getUri()
            );
        } catch (RouteNotFoundException $e) {
            // HTTP 404: Not found
            throw new ResolverException($e->getMessage(), 404, $e);
        }
        $app = $app
            ->withRouted($routed);
        $routeEndpoints = $routed->routeName()->endpoints();
        $requestMethod = new Method($app->request()->getMethod());
        try {
            $controllerName = $routeEndpoints->getRouteEndpoint($requestMethod)->controller()->toString();
        } catch (MethodNotFoundException $e) {
            // HTTP 405: Method Not Allowed
            throw new ResolverException($e->getMessage(), 405, $e);
        }
        $this->builder = $this->builder
            ->withControllerName($controllerName)
            ->withControllerArguments(
                $routed->wildcards()
            )
            ->withBuild(
                $this->builder->build()
                    ->withApp($app)
            );
    }

    public function builder(): BuilderInterface
    {
        return $this->builder;
    }
}