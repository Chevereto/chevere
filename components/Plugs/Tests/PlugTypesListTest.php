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

namespace Chevere\Components\Plugs\Tests;

use Chevere\Components\Plugs\Interfaces\PlugTypeInterface;
use Chevere\Components\Plugs\Types\PlugTypesList;
use PHPUnit\Framework\TestCase;

final class PlugTypesListTest extends TestCase
{
    public function testConstruct(): void
    {
        $array = include dirname(__DIR__) . '/Types/list.php';
        $plugTypesList = new PlugTypesList;
        $this->assertEquals($array, $plugTypesList->toArray());
        /**
         * @var int $pos
         * @var PlugTypeInterface $plugType
         */
        foreach ($plugTypesList->getGenerator() as $pos => $plugType) {
            $this->assertIsInt($pos);
            $this->assertInstanceOf(PlugTypeInterface::class, $plugType, "@pos $pos");
        }
    }
}
