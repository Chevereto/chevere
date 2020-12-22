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
use Chevere\Tests\Pluggable\Plugs\EventListeners\_resources\TestEventListener;
use Laminas\Diactoros\StreamFactory;
use PHPUnit\Framework\TestCase;

final class EventListenersRunnerTest extends TestCase
{
    public function testConstruct(): void
    {
        $runner = new EventListenersRunner(new EventListenersQueue(), new Writers());
        $this->expectNotToPerformAssertions();
        $runner->run('anchor', []);
    }

    public function testRun(): void
    {
        $stream = (new StreamFactory())->createStream('');
        $writer = new StreamWriter($stream);
        $writers = (new Writers())->with($writer);
        $eventListener = new TestEventListener();
        $eventListenersQueue = (new EventListenersQueue())
            ->withAdded($eventListener);
        $runner = new EventListenersRunner($eventListenersQueue, $writers);
        $data = ['data'];
        $runner->run($eventListener->anchor(), $data);
        $this->assertSame(implode(' ', $data), $writer->toString());
    }
}
