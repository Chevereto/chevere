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

namespace Chevere\Interfaces\Description;

/**
 * Describes the component in charge of defining the description.
 */
interface GetDescriptionInterface
{
    /**
     * Provides the description.
     */
    public function getDescription(): string;
}
