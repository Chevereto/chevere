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

use Ds\Map;
use OutOfBoundsException;
use function DeepCopy\deep_copy;

/**
 * A type-hinted proxy for Ds\Map storing (int) routeId => [(string) methodName => (string) specJsonPath,]
 */
final class SpecIndexMap
{
    private Map $map;

    public function __construct()
    {
        $this->map = new Map;
    }

    public function map(): Map
    {
        return $this->map;
    }

    public function withPut(int $routeId, SpecMethods $specMethods): SpecIndexMap
    {
        $new = clone $this;
        $new->map = deep_copy($new->map);
        $new->map->put($routeId, $specMethods);

        return $new;
    }

    public function hasKey(int $routeId): bool
    {
        return $this->map->hasKey($routeId);
    }

    public function get(int $routeId): SpecMethods
    {
        return $this->map->get($routeId);
    }
}
