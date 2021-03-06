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

namespace Chevere\Tests\Workflow\_resources\src;

use Chevere\Components\Action\Action;
use Chevere\Components\Dependent\Dependencies;
use Chevere\Components\Dependent\Traits\DependentTrait;
use Chevere\Components\Parameter\Parameters;
use Chevere\Components\Parameter\StringParameter;
use Chevere\Interfaces\Dependent\DependenciesInterface;
use Chevere\Interfaces\Dependent\DependentInterface;
use Chevere\Interfaces\Filesystem\PathInterface;
use Chevere\Interfaces\Parameter\ArgumentsInterface;
use Chevere\Interfaces\Parameter\ParametersInterface;
use Chevere\Interfaces\Response\ResponseInterface;

class WorkflowRunnerTestDependentStep1 extends Action implements DependentInterface
{
    use DependentTrait;

    public function getDependencies(): DependenciesInterface
    {
        return new Dependencies(
            path: PathInterface::class
        );
    }

    public function getParameters(): ParametersInterface
    {
        return new Parameters(foo: new StringParameter());
    }

    public function getResponseParameters(): ParametersInterface
    {
        return new Parameters(response1: new StringParameter());
    }

    public function run(ArgumentsInterface $arguments): ResponseInterface
    {
        return $this->getResponse(
            response1: $arguments->getString('foo')
        );
    }
}
