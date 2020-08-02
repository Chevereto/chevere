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

use Chevere\Components\Response\ResponseSuccess;
use Chevere\Components\Workflow\Task;
use Chevere\Components\Workflow\Workflow;
use Chevere\Components\Workflow\WorkflowRun;
use Chevere\Exceptions\Core\ArgumentCountException;
use Chevere\Exceptions\Core\OutOfBoundsException;
use Chevere\Interfaces\Response\ResponseInterface;
use PHPUnit\Framework\TestCase;

final class WorkflowRunTest extends TestCase
{
    public function testConstruct(): void
    {
        $workflow = (new Workflow('test-workflow'))
            ->withAdded(
                'step',
                (new Task('Chevere\Tests\Workflow\workflowRunTestStep1'))
                    ->withArguments('${foo}')
            );
        $arguments = ['foo' => 'bar'];
        $workflowRun = new WorkflowRun($workflow, $arguments);
        $this->assertMatchesRegularExpression(
            '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
            $workflowRun->uuid()
        );
        $this->assertSame($workflow, $workflowRun->workflow());
        $this->assertSame($arguments, $workflowRun->arguments()->toArray());
        $this->expectException(OutOfBoundsException::class);
        $workflowRun->get('not-found');
    }

    public function testWithAdded(): void
    {
        $workflow = (new Workflow('test-workflow'))
            ->withAdded(
                'step-0',
                (new Task('Chevere\Tests\Workflow\workflowRunTestStep1'))
                    ->withArguments('${foo}')
            )
            ->withAdded(
                'step-1',
                (new Task('Chevere\Tests\Workflow\workflowRunTestStep2'))
                    ->withArguments('${step-0:response-0}', '${bar}')
            );
        $arguments = [
            'foo' => 'hola',
            'bar' => 'mundo'
        ];
        $responseData = ['response-0' => 'value'];
        $workflowRun = (new WorkflowRun($workflow, $arguments))
            ->withAdded('step-0', new ResponseSuccess($responseData));
        $this->assertTrue($workflow->hasVar('${step-0:response-0}'));
        $this->assertTrue($workflowRun->has('step-0'));
        $this->assertSame($responseData, $workflowRun->get('step-0')->data());
    }

    public function testWithAddedNotFound(): void
    {
        $workflow = (new Workflow('test-workflow'))
            ->withAdded(
                'step-0',
                (new Task('Chevere\Tests\Workflow\workflowRunTestStep1'))
                    ->withArguments('${foo}')
            );
        $arguments = ['foo' => 'hola'];
        $this->expectException(OutOfBoundsException::class);
        (new WorkflowRun($workflow, $arguments))
            ->withAdded('not-found', new ResponseSuccess([]));
    }

    public function testWithAddedMissingArguments(): void
    {
        $workflow = (new Workflow('test-workflow'))
            ->withAdded(
                'step-0',
                new Task('Chevere\Tests\Workflow\workflowRunTestStep0')
            )
            ->withAdded(
                'step-1',
                (new Task('Chevere\Tests\Workflow\workflowRunTestStep1'))
                    ->withArguments('${step-0:response-0}')
            );
        $this->expectException(ArgumentCountException::class);
        (new WorkflowRun($workflow, []))
            ->withAdded('step-0', new ResponseSuccess([]));
    }
}

function workflowRunTestStep0(): ResponseInterface
{
    return new ResponseSuccess([]);
}

function workflowRunTestStep1(string $foo): ResponseInterface
{
    return new ResponseSuccess([]);
}

function workflowRunTestStep2(string $foo, string $bar): ResponseInterface
{
    return new ResponseSuccess([]);
}