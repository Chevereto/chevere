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

use Chevere\Components\Cache\CacheKey;
use Chevere\Components\Cache\Interfaces\CacheInterface;
use Chevere\Components\Spec\Interfaces\SpecIndexCacheInterface;
use Chevere\Components\Spec\Interfaces\SpecIndexInterface;
use Chevere\Components\Variable\VariableExport;

// Add this header to all responses: Link: </spec/api/routes.json>; rel="describedby"
final class SpecIndexCache implements SpecIndexCacheInterface
{
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function has(string $routeName): bool
    {
        $cacheKey = new CacheKey($routeName);

        return $this->cache->exists($cacheKey);
    }

    public function get(string $routeName): SpecMethods
    {
        $cacheKey = new CacheKey($routeName);

        return $this->cache->get($cacheKey)->var();
    }

    public function put(SpecIndexInterface $specIndex): void
    {
        /**
         * @var string $routeName
         * @var SpecMethods $specMethods
         */
        foreach ($specIndex->specIndexMap()->map() as $routeName => $specMethods) {
            $this->cache->withPut(
                new CacheKey($routeName),
                new VariableExport($specMethods)
            );
        }
    }

    public function puts(): array
    {
        return $this->cache->puts();
    }
}