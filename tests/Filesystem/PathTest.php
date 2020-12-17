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

namespace Chevere\Tests\Filesystem;

use Chevere\Components\Filesystem\Path;
use Chevere\Exceptions\Filesystem\PathNotExistsException;
use Chevere\Interfaces\Filesystem\PathInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class PathTest extends TestCase
{
    public function getPath(string $child): PathInterface
    {
        return (new Path(__DIR__ . '/'))->getChild($child);
    }

    public function testFilesystemPath(): void
    {
        $this->expectNotToPerformAssertions();
        new Path('/var/fake_' . uniqid());
    }

    public function testNonExistentPath(): void
    {
        $path = new Path('/var/fake_' . uniqid());
        $this->assertFalse($path->exists());
        $this->assertFalse($path->isDir());
        $this->assertFalse($path->isFile());
        $this->expectException(PathNotExistsException::class);
        $path->assertExists();
    }

    public function testExistentDirPath(): void
    {
        $path = new Path(__DIR__);
        $path->assertExists();
        $this->assertTrue($path->exists());
        $this->assertTrue($path->isDir());
        $this->assertFalse($path->isFile());
    }

    public function testExistentFilePath(): void
    {
        $path = new Path(__FILE__);
        $path->assertExists();
        $this->assertTrue($path->exists());
        $this->assertTrue($path->isFile());
        $this->assertFalse($path->isDir());
    }

    public function testExistentDirPathRemoved(): void
    {
        $path = $this->getPath('var/PathTest_dir_' . uniqid());
        $this->assertFalse($path->exists());
        if (!mkdir($path->toString(), 0777, true)) {
            throw new RuntimeException('Unable to create dir ' . $path->toString());
        }
        $this->assertTrue($path->exists());
        $this->assertTrue($path->isDir());
        if (!rmdir($path->toString())) {
            throw new RuntimeException('Unable to remove dir ' . $path->toString());
        }
        $this->assertFalse($path->exists());
        $this->assertFalse($path->isDir());
    }

    public function testExistentFilePathRemoved(): void
    {
        $path = $this->getPath('var/PathTest_file_' . uniqid() . '.jpg');
        $this->assertFalse($path->exists());
        if (false === file_put_contents($path->toString(), 'file put contents')) {
            throw new RuntimeException('Unable to create file ' . $path->toString());
        }
        $this->assertTrue($path->exists());
        $this->assertTrue($path->isFile());
        if (!unlink($path->toString())) {
            throw new RuntimeException('Unable to remove file ' . $path->toString());
        }
        $this->assertFalse($path->exists());
        $this->assertFalse($path->isFile());
        $this->expectException(PathNotExistsException::class);
        $path->isReadable();
    }
}
