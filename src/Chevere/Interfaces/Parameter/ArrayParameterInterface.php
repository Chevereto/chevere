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

namespace Chevere\Interfaces\Parameter;

use Chevere\Exceptions\Core\InvalidArgumentException;

/**
 * Describes the component in charge of defining a parameter of type array.
 */
interface ArrayParameterInterface extends ParameterInterface
{
    /**
     * Return an instance with the specified `$default` value.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$default` value.
     *
     * @throws InvalidArgumentException
     */
    public function withDefault(array $value): self;

    /**
     * Provides access to the default value.
     */
    public function default(): array;
}
