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

namespace Chevere\Tests\Workflow;

use Chevere\Components\Action\Action;
use Chevere\Components\Response\ResponseSuccess;
use Chevere\Components\Workflow\Steps;
use Chevere\Components\Workflow\Task;
use Chevere\Exceptions\Core\InvalidArgumentException;
use Chevere\Exceptions\Core\OverflowException;
use Chevere\Interfaces\Parameter\ArgumentsInterface;
use Chevere\Interfaces\Response\ResponseInterface;
use Chevere\Interfaces\Workflow\TaskInterface;
use PHPUnit\Framework\TestCase;

final class StepsTest extends TestCase
{
    private function getTask(): TaskInterface
    {
        return new Task(TestsActionStepsTests::class);
    }

    public function testConstruct(): void
    {
        $steps = new Steps;
        $this->assertCount(0, $steps);
    }

    public function testWithAdded(): void
    {
        $keys = [0 => 'step-1', 1 => 'step-3'];
        $task = new Task(TestsActionStepsTests::class);
        $steps = (new Steps)
            ->withAdded($keys[0], $task)
            ->withAdded($keys[1], $task);
        $this->assertSame($keys, $steps->keys());
        foreach ($steps->getGenerator() as $stepName => $stepTask) {
            $this->assertContains($stepName, $keys);
            $this->assertSame($task, $stepTask);
        }
        $this->expectException(OverflowException::class);
        $steps->withAdded($keys[1], $task);
    }
}

class TestsActionStepsTests extends Action
{
    public function run(ArgumentsInterface $arguments): ResponseInterface
    {
        return new ResponseSuccess([]);
    }
}
