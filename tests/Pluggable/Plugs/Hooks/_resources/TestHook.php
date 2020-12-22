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

namespace Chevere\Tests\Pluggable\Plugs\Hooks\_resources;

use Chevere\Interfaces\Pluggable\Plugs\Hooks\HookInterface;

class TestHook implements HookInterface
{
    public function __invoke(&$argument): void
    {
        $argument = "(hooked ${argument})";
    }

    public function anchor(): string
    {
        return 'setString:after';
    }

    public function at(): string
    {
        return TestHookable::class;
    }

    public function priority(): int
    {
        return 0;
    }
}
