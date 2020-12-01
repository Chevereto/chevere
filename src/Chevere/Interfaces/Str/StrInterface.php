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

namespace Chevere\Interfaces\Str;

use Chevere\Interfaces\To\ToStringInterface;

/**
 * Describes the component in charge of string manipulation.
 */
interface StrInterface extends ToStringInterface
{
    public function __construct(string $string);

    /**
     * Return an instance with the chars lower cased (UTF-8).
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the chars lower cased.
     */
    public function withLowercase(): StrInterface;

    /**
     * Return an instance with the chars upper cased (UTF-8).
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the chars upper cased.
     */
    public function withUppercase(): StrInterface;

    /**
     * Return an instance with the white space stripped.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the white space stripped.
     */
    public function withStripWhitespace(): StrInterface;

    /**
     * Return an instance with the extra white space stripped.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the extra white space stripped.
     */
    public function withStripExtraWhitespace(): StrInterface;

    /**
     * Return an instance with the non-alphanumeric chars stripped.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the non-alphanumeric chars stripped.
     */
    public function withStripNonAlphanumerics(): StrInterface;

    /**
     * Return an instance with the back slashes converted to forward slashes.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the back slashes converted to forward slashes.
     */
    public function withForwardSlashes(): StrInterface;

    /**
     * Return an instance with the specified `$tail` on left.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$tail` on left.
     */
    public function withLeftTail(string $tail): StrInterface;

    /**
     * Return an instance with the specified `$tail` on right.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$tail` on right.
     */
    public function withRightTail(string $tail): StrInterface;

    /**
     * Return an instance with the specified `$search` replaced with `$replace` on the first occurrence.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$search` replaced with `$replace` on the first occurrence.
     */
    public function withReplaceFirst(string $search, string $replace): StrInterface;

    /**
     * Return an instance with the specified `$search` replaced with `$replace` on the last occurrence.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$search` replaced with `$replace` on the last occurrence.
     */
    public function withReplaceLast(string $search, string $replace): StrInterface;

    /**
     * Return an instance with the specified `$search` replaced with `$replace` on all occurrences.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified `$search` replaced with `$replace` on all occurrences.
     */
    public function withReplaceAll(string $search, string $replace): StrInterface;

    /**
     * Return an instance with the ANSI colors stripped.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the ANSI colors stripped.
     */
    public function withStripANSIColors(): StrInterface;
}
