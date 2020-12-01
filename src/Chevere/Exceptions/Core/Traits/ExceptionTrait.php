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

namespace Chevere\Exceptions\Core\Traits;

use Chevere\Interfaces\Message\MessageInterface;

trait ExceptionTrait
{
    private MessageInterface $_message;

    public function message(): MessageInterface
    {
        return $this->_message;
    }
}
