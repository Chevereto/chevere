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

namespace Chevere\Tests\Action\_resources\src;

use Chevere\Components\Action\Action;
use Chevere\Interfaces\Parameter\ArgumentsInterface;
use Chevere\Interfaces\Response\ResponseInterface;

final class ActionTestEmptyAction extends Action
{
    public function run(ArgumentsInterface $arguments): ResponseInterface
    {
        return $this->getResponse();
    }
}
