<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\Components\Router\Exceptions;

use InvalidArgumentException;

/**
 * Exception thrown when a RouteContract path conflicts with others.
 */
final class RouteKeyConflictException extends InvalidArgumentException
{
}
