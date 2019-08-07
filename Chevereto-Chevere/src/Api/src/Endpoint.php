<?php

declare(strict_types=1);

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chevere\Api\src;

use Chevere\Controllers\Api\OptionsController;
use Chevere\Controllers\Api\HeadController;
use Chevere\Contracts\Api\src\EndpointContract;

/**
 * Creates endpoints from ControlerInspect object.
 */
final class Endpoint implements EndpointContract
{
    /** @var array */
    private $array;

    /** @var array */
    private $httpMethods;

    public function __construct(array $httpMethods)
    {
        $this->array = [];
        $this->httpMethods = $httpMethods;
        $this->fillEndpointOptions($this->httpMethods, $this->array);
        $this->autofillMissingOptionsHead($this->httpMethods, $this->array);
    }

    public function getHttpMethods(): array
    {
        return $this->httpMethods;
    }

    public function toArray(): array
    {
        return $this->array;
    }

    public function setResource(array $resource): void
    {
        $this->array['resource'] = $resource;
    }

    private function fillEndpointOptions(array &$httpMethods, array &$endpointApi)
    {
        foreach ($httpMethods as $httpMethod => $controllerClassName) {
            $httpMethodOptions = [];
            $httpMethodOptions['description'] = $controllerClassName::description();
            $controllerParameters = $controllerClassName::parameters();
            if (isset($controllerParameters)) {
                $httpMethodOptions['parameters'] = $controllerParameters;
            }
            $endpointApi['OPTIONS'][$httpMethod] = $httpMethodOptions;
        }
    }

    private function autofillMissingOptionsHead(array &$httpMethods, array &$endpointApi)
    {
        foreach ([
            'OPTIONS' => [
                OptionsController::class, [
                    'description' => OptionsController::description(),
                ],
            ],
            'HEAD' => [
                HeadController::class, [
                    'description' => HeadController::description(),
                ],
            ],
        ] as $k => $v) {
            if (!isset($httpMethods[$k])) {
                $httpMethods[$k] = $v[0];
                $endpointApi['OPTIONS'][$k] = $v[1];
            }
        }
    }
}