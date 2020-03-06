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

namespace Chevere\Components\Router\Interfaces;

use Chevere\Components\Route\Interfaces\RoutePathInterface;
use Chevere\Components\Route\RoutePath;

interface RouterIndexInterface
{
    public function withAdded(RoutePathInterface $routePath, int $id, string $group, string $name): RouterIndexInterface;

    public function has(RoutePath $routePath): bool;

    public function get(RoutePath $routePath): array;

    public function toArray(): array;
}
