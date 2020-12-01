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

namespace Chevere\Components\Router;

use Chevere\Components\Message\Message;
use Chevere\Components\Str\StrAssert;
use Chevere\Exceptions\Core\InvalidArgumentException;
use Chevere\Exceptions\Router\RouteIdentifierException;
use Chevere\Interfaces\Router\RouteIdentifierInterface;
use Throwable;

final class RouteIdentifier implements RouteIdentifierInterface
{
    private string $group;

    private string $name;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $group, string $name)
    {
        $this->group = $group;
        $this->assertString('group');
        $this->name = $name;
        $this->assertString('name');
    }

    public function group(): string
    {
        return $this->group;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'group' => $this->group,
            'name' => $this->name,
        ];
    }

    private function assertString(string $argumentName): void
    {
        try {
            (new StrAssert($this->$argumentName))
                ->notEmpty()
                ->notCtypeSpace();
        } catch (Throwable $e) {
            throw new InvalidArgumentException(
                (new Message('Argument %argumentName% must not be empty neither ctype-space.'))
                    ->code('%argumentName%', '$' . $argumentName)
            );
        }
    }
}
