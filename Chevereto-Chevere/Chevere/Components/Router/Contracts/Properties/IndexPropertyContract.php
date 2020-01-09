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

namespace Chevere\Components\Router\Contracts\Properties;

use Chevere\Components\Common\Contracts\ToArrayContract;
use Chevere\Components\Router\Exceptions\RouterPropertyException;

interface IndexPropertyContract extends ToArrayContract
{
    /** @var string property name */
    const NAME = 'index';

    public function __construct(array $index);
}