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

namespace Chevere\Interfaces\Plugin;

use Chevere\Exceptions\Core\OutOfBoundsException;
use Chevere\Exceptions\Core\RuntimeException;
use Chevere\Interfaces\Cache\CacheInterface;

/**
 * Describes the component in charge of caching a plugs map.
 */
interface PlugsMapCacheInterface
{
    const KEY_CLASS_MAP = 'classmap';

    public function __construct(CacheInterface $cache);

    /**
     * Return an instance with the specified `$plugsMap`.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$plugsMap`.
     *
     * @throws RuntimeException
     */
    public function withPut(PlugsMapInterface $plugsMap): PlugsMapCacheInterface;

    /**
     * Indicates whether the instance has a plugs queue typed for `$className`.
     */
    public function hasPlugsQueueTypedFor(string $className): bool;

    /**
     * Returns the plugs queue typed for `$className`.
     *
     * @throws OutOfBoundsException
     */
    public function getPlugsQueueTypedFor(string $className): PlugsQueueTypedInterface;
}
