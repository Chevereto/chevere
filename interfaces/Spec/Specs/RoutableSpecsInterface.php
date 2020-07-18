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

namespace Chevere\Interfaces\Spec\Specs;

use Chevere\Exceptions\Core\OutOfBoundsException;
use Chevere\Interfaces\DataStructures\DsMapInterface;
use Generator;

/**
 * Describes the component in charge of collecting objects implementing `RoutableSpecInterface`.
 */
interface RoutableSpecsInterface extends DsMapInterface
{
    /**
     * Return an instance with the specified `$routableSpec`.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$routableSpec`.
     */
    public function withPut(RoutableSpecInterface $routableSpec): RoutableSpecsInterface;

    /**
     * Indicates whether the instance has a routable spec identified by its `$routeName`.
     */
    public function has(string $routeName): bool;

    /**
     * Returns the routable spec identified by its `$routeName`.
     * @throws OutOfBoundsException
     */
    public function get(string $routeName): RoutableSpecInterface;

    /**
     * @return Generator<string, RoutableSpecInterface>
     */
    public function getGenerator(): Generator;
}
