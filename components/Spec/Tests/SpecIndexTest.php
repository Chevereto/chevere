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

namespace Chevere\Components\Spec\Tests;

use Chevere\Components\Http\Methods\GetMethod;
use Chevere\Components\Http\Methods\PutMethod;
use Chevere\Components\Route\RouteEndpoint;
use Chevere\Components\Spec\RouteEndpointSpec;
use Chevere\Components\Spec\SpecIndex;
use Chevere\Components\Spec\SpecPath;
use Chevere\TestApp\App\Controllers\TestController;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

final class SpecIndexTest extends TestCase
{
    public function testConstruct(): void
    {
        $specIndex = new SpecIndex;
        $method = new GetMethod;
        $this->assertFalse($specIndex->has(0, $method::name()));
        $this->assertCount(0, $specIndex->specIndexMap()->map());
        $this->assertFalse($specIndex->specIndexMap()->hasKey(0));
        $this->expectException(OutOfBoundsException::class);
        $specIndex->get(0, $method::name());
    }

    public function testWithOffset(): void
    {
        $method = new GetMethod;
        $routeEndpoint = new RouteEndpoint($method, new TestController);
        $specPath = new SpecPath('/spec/group/route');
        $routeEndpointSpec = new RouteEndpointSpec($specPath, $routeEndpoint);
        $specIndex = (new SpecIndex)->withOffset(1, $routeEndpointSpec);
        $this->assertFalse($specIndex->has(0, $method->name()));
        $this->assertTrue($specIndex->has(1, $method->name()));
        $this->assertCount(1, $specIndex->specIndexMap()->map());
        $this->assertSame(
            $specPath->getChild($method->name() . '.json')->pub(),
            $specIndex->get(1, $method->name())
        );
        //
        $method2 = new PutMethod;
        $routeEndpoint2 = new RouteEndpoint($method2, new TestController);
        $routeEndpointSpec2 = new RouteEndpointSpec($specPath, $routeEndpoint2);
        $specIndex = $specIndex->withOffset(1, $routeEndpointSpec2);
        $this->assertTrue($specIndex->has(1, $method->name()));
        $this->assertTrue($specIndex->has(1, $method2->name()));
        $this->assertCount(1, $specIndex->specIndexMap()->map());
        $this->assertSame(
            $specPath->getChild($method2->name() . '.json')->pub(),
            $specIndex->get(1, $method2->name())
        );
    }
}
