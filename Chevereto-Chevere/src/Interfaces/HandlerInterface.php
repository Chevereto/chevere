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

use Chevere\App\App;

interface HandlerInterface
{
    public function process(App $app);

    public function stop(App $app);
}
