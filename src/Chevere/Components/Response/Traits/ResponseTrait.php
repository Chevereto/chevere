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

namespace Chevere\Components\Response\Traits;

use Ramsey\Uuid\Uuid;

trait ResponseTrait
{
    private string $uuid;

    private string $token;

    private array $data = [];

    private int $status = 0;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4()->toString();
        $this->token = bin2hex(random_bytes(128));
    }

    public function withStatus(int $code): self
    {
        $new = clone $this;
        $new->status = $code;

        return $new;
    }

    public function withData(mixed ...$namedData): self
    {
        $new = clone $this;
        $new->data = $namedData;

        return $new;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function status(): int
    {
        return $this->status;
    }
}
