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

namespace Chevere\Components\Spec;

use Chevere\Components\DataStructures\Traits\MapTrait;
use Chevere\Components\Message\Message;
use Chevere\Exceptions\Core\OutOfBoundsException;
use Chevere\Exceptions\Core\TypeException;
use Chevere\Interfaces\Spec\SpecEndpointsInterface;
use Chevere\Interfaces\Spec\Specs\RouteEndpointSpecInterface;
use TypeError;
use function Chevere\Components\Type\debugType;
use function Chevere\Components\Type\returnTypeExceptionMessage;

final class SpecEndpoints implements SpecEndpointsInterface
{
    use MapTrait;

    public function withPut(RouteEndpointSpecInterface $routeEndpointSpec): SpecEndpointsInterface
    {
        $new = clone $this;
        $new->map->put(
            $routeEndpointSpec->key(),
            $routeEndpointSpec->jsonPath()
        );

        return $new;
    }

    public function has(string $methodName): bool
    {
        return $this->map->hasKey(/** @scrutinizer ignore-type */ $methodName);
    }

    public function get(string $methodName): string
    {
        try {
            /**
             * @var string $return
             */
            $return = $this->map->get($methodName);

            return $return;
        }
        // @codeCoverageIgnoreStart
        catch (TypeError $e) {
            throw new TypeException(
                returnTypeExceptionMessage('string', debugType($return))
            );
        } catch (\OutOfBoundsException $e) {
            throw new OutOfBoundsException(
                (new Message('Method name %methodName% not found'))
                    ->code('%methodName%', $methodName)
            );
        }
        // @codeCoverageIgnoreEnd
    }
}
