<?php

declare(strict_types=1);

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chevere\Interfaces;

use Chevere\Contracts\App\AppContract;

interface HandlerInterface
{
    public function process(AppContract $app);

    public function stop(AppContract $app);
}
