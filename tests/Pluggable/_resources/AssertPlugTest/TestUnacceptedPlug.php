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

namespace Chevere\Tests\Pluggable\_resources\AssertPlugTest;

use Chevere\Interfaces\Pluggable\PlugInterface;

final class TestUnacceptedPlug implements PlugInterface
{
    public function __invoke(&$argument): void
    {
        return;
    }

    public function anchor(): string
    {
        return '';
    }

    public function at(): string
    {
        return '';
    }

    public function priority(): int
    {
        return 0;
    }
}
