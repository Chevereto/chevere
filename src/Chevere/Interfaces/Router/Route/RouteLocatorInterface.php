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

namespace Chevere\Interfaces\Router\Route;

use Chevere\Interfaces\Common\ToStringInterface;

/**
 * Describes the component in charge of defining a route name.
 */
interface RouteLocatorInterface extends ToStringInterface
{
    public function __construct(string $repository, string $name);

    public function repository(): string;

    public function path(): string;
}
