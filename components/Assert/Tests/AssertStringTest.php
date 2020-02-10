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

namespace Chevere\Components\Assert\Tests;

use Chevere\Components\Assert\AssertString;
use Chevere\Components\Assert\Exceptions\AssertStringException;
use PHPUnit\Framework\TestCase;

final class AssertStringTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(AssertStringException::class);
        (new AssertString(''))->notEmpty();
    }

    public function testNotEmpty(): void
    {
        $this->expectNotToPerformAssertions();
        foreach ([
            ' ', '0'
        ] as $valid) {
            (new AssertString($valid))->notEmpty();
        }
    }

    public function testCtypeSpace(): void
    {
        $this->expectException(AssertStringException::class);
        (new AssertString(" \n\t\r"))->notCtypeSpace();
    }

    public function testNotCtypeSpace(): void
    {
        $this->expectNotToPerformAssertions();
        foreach ([
            'like anything', "\n else"
        ] as $valid) {
            (new AssertString($valid))->notCtypeSpace();
        }
    }
}