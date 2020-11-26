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

namespace Chevere\Tests\Response;

use Chevere\Components\Parameter\IntegerParameter;
use Chevere\Components\Parameter\Parameters;
use Chevere\Components\Parameter\StringParameter;
use Chevere\Components\Response\ResponseFailure;
use Chevere\Components\Response\ResponseSuccess;
use Chevere\Components\Workflow\Workflow;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\Validator;
use function Chevere\Components\Workflow\getWorkflowMessage;

final class ResponseTest extends TestCase
{
    public function testConstructResponseSuccess(): void
    {
        $data = ['data'];
        $response = new ResponseSuccess(
            (new Parameters)
                ->withAddedRequired(new StringParameter('0')),
            $data
        );
        $this->assertSame($data, $response->data());
        $this->assertTrue(
            (new Validator())->validate($response->uuid()),
            'Invalid UUID'
        );
        $this->assertIsString($response->token());
    }

    public function testResponseSuccessWithData(): void
    {
        $response = new ResponseSuccess(new Parameters, []);
        $this->assertSame([], $response->data());
        $data = ['data'];
        $response = $response->withData($data);
        $this->assertSame($data, $response->data());
    }

    public function testConstructResponseFailure(): void
    {
        $data = ['0' => 'data'];
        $response = new ResponseFailure(
            (new Parameters)
                ->withAddedRequired(new StringParameter('0')),
            $data
        );
        $this->assertSame($data, $response->data());
    }

    public function testResponseFailureWithData(): void
    {
        $response = new ResponseFailure(new Parameters, []);
        $this->assertSame([], $response->data());
        $data = ['data'];
        $response = $response->withData($data);
        $this->assertSame($data, $response->data());
    }

    public function testResponseSuccessWithWorkflowMessage(): void
    {
        $data = [
            'delay' => 123,
            'expiration' => 111,
        ];
        $workflowMessage = getWorkflowMessage(new Workflow('name'), [])
            ->withDelay($data['delay'])
            ->withExpiration($data['expiration'])
            ->withPriority(10);
        $response = (new ResponseSuccess(new Parameters, []))
            ->withWorkflowMessage($workflowMessage);
        $this->assertSame($workflowMessage, $response->workflowMessage());
        $this->assertSame($data, $response->data());
    }
}
