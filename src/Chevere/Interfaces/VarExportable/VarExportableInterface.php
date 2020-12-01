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

namespace Chevere\Interfaces\VarExportable;

use Chevere\Exceptions\VarExportable\VarExportableException;

/**
 * Describes the component in charge of handling exportable variables.
 */
interface VarExportableInterface
{
    /**
     * @throws VarExportableException if `$var` can't be exported.
     */
    public function __construct($var);

    /**
     * Provides access to `$var`.
     */
    public function var();

    /**
     * Shorthand for `\var_export($var)`.
     */
    public function toExport();

    /**
     * Shorthand for `\serialize($var)`.
     */
    public function toSerialize(): string;
}
