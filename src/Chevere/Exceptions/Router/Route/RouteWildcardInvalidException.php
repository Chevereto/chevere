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

namespace Chevere\Exceptions\Router\Route;

use Chevere\Exceptions\Core\Exception;

/**
 * Exception thrown when the wildcard contains invalid chars.
 */
final class RouteWildcardInvalidException extends Exception
{
}
