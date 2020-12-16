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

namespace Chevere\Tests\Plugin\_resources\PlugsMapperTest;

use Chevere\Components\Plugin\PluggableAnchors;
use Chevere\Components\Plugin\Plugs\Hooks\Traits\PluggableHooksTrait;
use Chevere\Interfaces\Plugin\PluggableAnchorsInterface;
use Chevere\Interfaces\Plugin\Plugs\Hooks\PluggableHooksInterface;

class TestMappedHookable implements PluggableHooksInterface
{
    use PluggableHooksTrait;

    private string $string;

    public static function getHookAnchors(): PluggableAnchorsInterface
    {
        return (new PluggableAnchors())
            ->withAdded('hook-anchor-1');
    }

    public function __construct()
    {
        $string = '';
        $this->hook('hook-anchor-1', $string);

        $this->string = $string;
    }

    public function string(): string
    {
        return $this->string;
    }
}
