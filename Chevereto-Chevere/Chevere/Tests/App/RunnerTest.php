<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\Tests\App;

use Chevere\Components\App\App;
use Chevere\Components\App\Build;
use Chevere\Components\App\Builder;
use Chevere\Components\App\Exceptions\RouterCantResolveException;
use Chevere\Components\App\Exceptions\RouterContractRequiredException;
use Chevere\Components\App\Parameters;
use Chevere\Components\App\Runner;
use Chevere\Components\App\Services;
use Chevere\Components\ArrayFile\ArrayFile;
use Chevere\Components\File\File;
use Chevere\Components\File\FilePhp;
use Chevere\Components\Http\Request;
use Chevere\Components\Http\Response;
use Chevere\Components\Path\Path;
use Chevere\Components\Router\RouterMaker;
use Chevere\Components\Router\Router;
use Chevere\Contracts\App\BuildContract;
use PHPUnit\Framework\TestCase;

final class RunnerTest extends TestCase
{
    private function getTestBuild(): BuildContract
    {
        $build = $this->getDummyBuild();
        $parameters = new Parameters(
            new ArrayFile(
                new FilePhp(
                    new File(
                        new Path('parameters.php')
                    )
                )
            )
        );

        return $build
            ->withParameters($parameters)
            ->withRouterMaker(new RouterMaker());
    }

    private function getDummyBuild(): BuildContract
    {
        $services = new Services();
        $response = new Response();
        $app = new App($services, $response);
        $path = new Path('build');

        return new Build($app, $path);
    }

    public function testConstructor(): void
    {
        $build = $this->getDummyBuild();
        $builder = new Builder($build);
        $runner = new Runner($builder);
        $this->assertSame($builder, $runner->builder());
    }

    public function testWithConsoleLoop(): void
    {
        $build = $this->getDummyBuild();
        $builder = new Builder($build);
        $runner = (new Runner($builder))
            ->withConsoleLoop();
        $this->assertTrue($runner->hasConsoleLoop());
    }

    public function testWithRunnerWithoutRouter(): void
    {
        $build = $this->getDummyBuild();
        $builder = new Builder($build);
        $runner = new Runner($builder);
        $this->expectException(RouterContractRequiredException::class);
        $runner->withRun();
    }

    public function testWithRunWithRouterUnableToResolve(): void
    {
        $router = new Router();
        $services = (new Services())
            ->withRouter($router);
        $response = new Response();
        $app = new App($services, $response);
        $path = new Path('build');
        $build = new Build($app, $path);
        $builder = new Builder($build);
        $runner = new Runner($builder);
        $this->expectException(RouterCantResolveException::class);
        $runner->withRun();
    }

    public function testRunnerNotFound(): void
    {
        $build = $this->getTestBuild();
        $builder = new Builder($build->make());
        $app = $builder->build()->app()
            ->withRequest(new Request('GET', '/404'));
        $builder = $builder
            ->withBuild(
                $builder->build()->withApp($app)
            );
        $runner = new Runner($builder);
        $ranBuilder = $runner->withRun()->builder();
        $build->destroy();
        $this->assertSame(404, $ranBuilder->build()->app()->response()->guzzle()->getStatusCode());
    }

    public function testRunnerFoundBadMethod(): void
    {
        $build = $this->getTestBuild();
        $builder = new Builder($build->make());
        $app = $builder->build()->app()
            ->withRequest(new Request('POST', '/test'));
        $builder = $builder
            ->withBuild(
                $builder->build()->withApp($app)
            );
        $runner = new Runner($builder);
        $ranBuilder = $runner->withRun()->builder();
        $build->destroy();
        $this->assertSame(405, $ranBuilder->build()->app()->response()->guzzle()->getStatusCode());
    }

    public function testRunnerFound(): void
    {
        $build = $this->getTestBuild();
        $builder = new Builder($build->make());
        $app = $builder->build()->app()
            ->withRequest(new Request('GET', '/test'));
        $builder = $builder
            ->withBuild(
                $builder->build()->withApp($app)
            );
        $runner = new Runner($builder);
        $ranBuilder = $runner->withRun()->builder();
        $build->destroy();
        $this->assertSame(200, $ranBuilder->build()->app()->response()->guzzle()->getStatusCode());
    }
}
