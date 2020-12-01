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

namespace Chevere\Interfaces\VarDump;

/**
 * The template strings used by VarDump.
 */
interface VarDumpTemplateInterface
{
    const HTML_INLINE_PREFIX = ' <span style="border-left: 1px solid rgba(236,240,241,.1);"></span>  ';
    const HTML_EMPHASIS = '<em>%s</em>';
}
