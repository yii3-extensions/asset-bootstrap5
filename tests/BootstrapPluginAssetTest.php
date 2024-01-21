<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use PHPUnit\Framework\Attributes\RequiresPhp;
use Yii\Asset\BootstrapPluginAsset;
use Yii\Asset\Tests\Support\TestSupport;

use function runkit_constant_redefine;

final class BootstrapPluginAssetTest extends \PHPUnit\Framework\TestCase
{
    use TestSupport;

    public function testRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $this->assertSame(
            [
                '/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css'],
            ],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css.map');
        $this->assertFileDoesNotExist(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css');
        $this->assertFileDoesNotExist(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css.map');

        $this->assertSame(
            [
                '/16b8de20/bootstrap.bundle.js' => ['/16b8de20/bootstrap.bundle.js'],
            ],
            $this->assetManager->getJsFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.js');
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.js.map');
        $this->assertFileDoesNotExist(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js');
        $this->assertFileDoesNotExist(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js.map');
    }

    #[RequiresPhp('8.1')]
    public function testRegisterWithEnvironmentProd(): void
    {
        @runkit_constant_redefine('YII_ENV', 'prod');

        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $this->assertSame(
            [
                '/55145ba9/bootstrap.min.css' => ['/55145ba9/bootstrap.min.css'],
            ],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css.map');
        $this->assertSame(
            [
                '/16b8de20/bootstrap.bundle.min.js' => ['/16b8de20/bootstrap.bundle.min.js'],
            ],
            $this->assetManager->getJsFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js');
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js.map');

        @runkit_constant_redefine('YII_ENV', 'test');
    }
}
