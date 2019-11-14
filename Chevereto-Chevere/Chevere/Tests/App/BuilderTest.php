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
use Chevere\Components\App\Services;
use Chevere\Components\Http\Response;
use Chevere\Components\Path\Path;
use Chevere\Components\Router\Maker;
use Chevere\Contracts\App\BuildContract;
use PHPUnit\Framework\TestCase;

final class BuilderTest extends TestCase
{
    private function getBuild(): BuildContract
    {
        $app = new App(new Services(), new Response());

        return new Build($app, new Path('build'));
    }

    public function testConstruct(): void
    {
        $build = $this->getBuild();
        $builder = new Builder($build);
        $this->assertSame($build->app(), $builder->build()->app());
        $this->assertSame($build, $builder->build());
    }

    public function testWithApp(): void
    {
        $build = $this->getBuild();
        $app = $build->app();
        $appAlt = $app->withArguments([1, 2, 3]);
        $builder = new Builder($build);
        $builder = $builder
          ->withBuild(
              $build->withApp($appAlt)
          );

        $this->assertSame($appAlt, $builder->build()->app());
    }

    public function testWithBuild(): void
    {
        $build = $this->getBuild();
        $buildAlt = $build->withRouterMaker(new Maker());
        $builder = (new Builder($build))
          ->withBuild($buildAlt);

        $this->assertSame($buildAlt, $builder->build());
    }

    public function testWithControllerName(): void
    {
        $build = $this->getBuild();
        $controllerName = 'ControllerName';
        $builder = (new Builder($build))
          ->withControllerName($controllerName);

        $this->assertTrue($builder->hasControllerName());
        $this->assertSame($controllerName, $builder->controllerName());
    }

    public function testWithControllerArguments(): void
    {
        $build = $this->getBuild();
        $controllerArguments = [1, 2, 3];
        $builder = (new Builder($build))
          ->withControllerArguments($controllerArguments);

        $this->assertTrue($builder->hasControllerArguments());
        $this->assertSame($controllerArguments, $builder->controllerArguments());
    }
}