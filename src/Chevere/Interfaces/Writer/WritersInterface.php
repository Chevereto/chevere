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

namespace Chevere\Interfaces\Writer;

use Chevere\Exceptions\Core\LogicException;

interface WritersInterface
{
    /**
     * @throws LogicException
     */
    public function __construct();

    /**
     * Return an instance with the specified $writer for all writers.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified $writer for all writers.
     */
    public function with(WriterInterface $writer): WritersInterface;

    /**
     * Return an instance with the specified out WriterInterface.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified out WriterInterface.
     */
    public function withOut(WriterInterface $writer): WritersInterface;

    public function out(): WriterInterface;

    /**
     * Return an instance with the specified error WriterInterface.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified error WriterInterface.
     */
    public function withError(WriterInterface $writer): WritersInterface;

    public function error(): WriterInterface;

    /**
     * Return an instance with the specified debug WriterInterface.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified debug WriterInterface.
     */
    public function withDebug(WriterInterface $writer): WritersInterface;

    public function debug(): WriterInterface;

    /**
     * Return an instance with the specified log WriterInterface.
     *
     * This method MUST retain the state of the current instance, and return
     * an instance that contains the specified log WriterInterface.
     */
    public function withLog(WriterInterface $writer): WritersInterface;

    public function log(): WriterInterface;
}
