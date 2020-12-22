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

namespace Chevere\Tests\Pluggable\Plugs\Hooks;

use Chevere\Components\Pluggable\Plugs\Hooks\HooksRunnerNull;
use PHPUnit\Framework\TestCase;
use stdClass;

final class HooksRunnerNullTest extends TestCase
{
    public function testConstruct(): void
    {
        $runner = new HooksRunnerNull();
        $argument = new stdClass();
        $same = $argument;
        $runner->run('anchor', $argument);
        $this->assertSame($same, $argument);
    }
}
