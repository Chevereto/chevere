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

namespace Chevere\Components\Response;

use Chevere\Components\Response\Traits\ResponseTrait;
use Chevere\Interfaces\Response\ResponseSuccessInterface;
use Chevere\Interfaces\Workflow\WorkflowMessageInterface;

final class ResponseSuccess implements ResponseSuccessInterface
{
    use ResponseTrait;

    private WorkflowMessageInterface $workflowMessage;

    public function withData(array $data): ResponseSuccessInterface
    {
        $new = clone $this;
        $new->data = $data;

        return $new;
    }

    public function withWorkflowMessage(WorkflowMessageInterface $workflowMessage): ResponseSuccessInterface
    {
        $new = clone $this;
        $new->workflowMessage = $workflowMessage;
        $new->data = array_merge($new->data, [
            'delay' => $workflowMessage->delay(),
            'expiration' => $workflowMessage->expiration(),
        ]);

        return $new;
    }

    public function workflowMessage(): WorkflowMessageInterface
    {
        return $this->workflowMessage;
    }
}