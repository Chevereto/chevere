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

namespace Chevere\Tests\Pluggable\Plugs\EventListeners;

use Chevere\Components\Pluggable\Plugs\EventListeners\EventListenersQueue;
use Chevere\Components\Pluggable\Plugs\EventListeners\EventListenersRunner;
use Chevere\Components\Writer\StreamWriter;
use Chevere\Components\Writer\Writers;
use Chevere\Tests\Pluggable\Plugs\EventListeners\_resources\TestEventable;
use Chevere\Tests\Pluggable\Plugs\EventListeners\_resources\TestEventListener;
use Laminas\Diactoros\StreamFactory;
use PHPUnit\Framework\TestCase;

final class EventedTest extends TestCase
{
    public function testWithoutEventListenersQueue(): void
    {
        $string = 'string';
        $testEventable = new TestEventable();
        $testEventable->setString($string);
        $this->assertSame($string, $testEventable->string());
    }

    public function testEventListeners(): void
    {
        $writer = new StreamWriter((new StreamFactory())->createStream(''));
        $writers = (new Writers())->with($writer);
        $string = 'string';
        $eventListenersQueue = (new EventListenersQueue())->withAdded(new TestEventListener());
        /** @var TestEventable $testEventable */
        $testEventable = (new TestEventable())
            ->withEventListenersRunner(
                new EventListenersRunner($eventListenersQueue, $writers)
            );
        $testEventable->setString($string);
        $this->assertSame($writers->out()->toString(), implode(' ', [$string]));
    }

    public function testNotEventedClass(): void
    {
        $string = 'string';
        $testEventable = new TestEventable();
        $testEventable->setString($string);
        $this->assertSame($string, $testEventable->string());
    }
}
