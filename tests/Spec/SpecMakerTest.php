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

namespace Chevere\Tests\Spec;

use Chevere\Components\Http\Methods\GetMethod;
use Chevere\Components\Http\Methods\PutMethod;
use Chevere\Components\Route\Route;
use Chevere\Components\Route\RouteEndpoint;
use Chevere\Components\Route\RouteName;
use Chevere\Components\Route\RoutePath;
use Chevere\Components\Router\Routable;
use Chevere\Components\Router\Router;
use Chevere\Components\Spec\SpecMaker;
use Chevere\Components\Spec\SpecPath;
use Chevere\Exceptions\Core\InvalidArgumentException;
use Chevere\Interfaces\Filesystem\DirInterface;
use Chevere\Tests\Spec\_resources\src\SpecMakerTestGetController;
use Chevere\Tests\Spec\_resources\src\SpecMakerTestPutController;
use Chevere\Tests\src\DirHelper;
use PHPUnit\Framework\TestCase;

final class SpecMakerTest extends TestCase
{
    private DirHelper $dirHelper;

    private DirInterface $buildDir;

    public function setUp(): void
    {
        $this->dirHelper = new DirHelper($this);
        $this->buildDir = $this->dirHelper->dir()->getChild('build/');
    }

    public function testConstructInvalidArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new SpecMaker(
            new SpecPath('/spec'),
            $this->buildDir->getChild('spec/'),
            new Router
        );
    }

    public function testBuild(): void
    {
        $putMethod = new PutMethod;
        $getMethod = new GetMethod;
        $route = new Route(
            new RouteName('MyRoute'),
            new RoutePath('/route-path/{id:[0-9]+}')
        );
        $route = $route
            ->withAddedEndpoint(
                new RouteEndpoint($putMethod, new SpecMakerTestPutController)
            )
            ->withAddedEndpoint(
                new RouteEndpoint($getMethod, new SpecMakerTestGetController)
            );
        $router = (new Router)
            ->withAddedRoutable(new Routable($route), 'group-name');
        $specMaker = new SpecMaker(
            new SpecPath('/spec'),
            $this->buildDir->getChild('spec/'),
            $router
        );
        $buildPath = $this->buildDir->path();
        foreach ($specMaker->files() as $jsonPath => $path) {
            $cachedFile = $buildPath->getChild(ltrim($jsonPath, '/'))->absolute();
            $this->assertFileEquals(
                $cachedFile,
                $path->absolute(),
                $cachedFile
            );
        }
        $this->assertTrue($specMaker->specIndex()->has(
            $route->name()->toString(),
            $putMethod->name()
        ));
        $this->assertTrue($specMaker->specIndex()->has(
            $route->name()->toString(),
            $getMethod->name()
        ));
    }
}