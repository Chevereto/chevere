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

use Chevere\Components\App\Exceptions\ParametersDuplicatedException;
use Chevere\Components\App\Exceptions\ParametersWrongKeyException;
use Chevere\Components\App\Exceptions\ParametersWrongTypeException;
use Chevere\Components\App\Parameters;
use Chevere\Components\ArrayFile\ArrayFile;
use Chevere\Components\File\File;
use Chevere\Components\File\FilePhp;
use Chevere\Components\Path\Path;
use Chevere\Contracts\App\ParametersContract;
use Chevere\Contracts\ArrayFile\ArrayFileContract;
use Chevere\Contracts\Path\PathContract;
use PHPUnit\Framework\TestCase;

final class ParametersTest extends TestCase
{
    public function getArrayFile(PathContract $path): ArrayFileContract
    {
        return
            new ArrayFile(
                new FilePhp(
                    new File($path)
                )
            );
    }

    public function testConstructorWrongKey(): void
    {
        $arrayFile = $this->getArrayFile(
            new Path('parameters/wrongKey.php')
        );
        $this->expectException(ParametersWrongKeyException::class);
        new Parameters($arrayFile);
    }

    public function testConstructorWrongRoutesType(): void
    {
        $arrayFile = $this->getArrayFile(
            new Path('parameters/wrongRoutesType.php')
        );
        $this->expectException(ParametersWrongTypeException::class);
        new Parameters($arrayFile);
    }

    public function testConstructorWrongApiType(): void
    {
        $arrayFile = $this->getArrayFile(
            new Path('parameters/wrongApiType.php')
        );
        $this->expectException(ParametersWrongTypeException::class);
        new Parameters($arrayFile);
    }

    public function testConstructorWithRoutes(): void
    {
        $arrayFile = $this->getArrayFile(
            new Path('parameters/routes.php')
        );
        $parameters = new Parameters($arrayFile);
        $this->assertSame(true, $parameters->hasParameters());
        $this->assertSame(true, $parameters->hasRoutes());
        $this->assertSame($arrayFile->array()[ParametersContract::KEY_ROUTES], $parameters->routes());
    }

    public function testWithDuplicatedAddedRoutePaths(): void
    {
        $arrayFile = $this->getArrayFile(
            new Path('parameters/routes.php')
        );
        $this->expectException(ParametersDuplicatedException::class);
        (new Parameters($arrayFile))
            ->withAddedRoutePaths(new Path('routes/test.php'));
    }
}
