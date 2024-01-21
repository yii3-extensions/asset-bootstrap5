<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use PHPUnit\Framework\Attributes\RequiresPhp;
use Yii\Asset\BootstrapAsset;
use Yii\Asset\Tests\Support\TestSupport;
use Yiisoft\Assets\AssetBundle;

use function runkit_constant_redefine;

final class BootstrapAssetTest extends \PHPUnit\Framework\TestCase
{
    use TestSupport;

    public function testRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapAsset::class));
        $this->assertSame(
            [
                '/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css'],
            ],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css.map');
    }

    #[RequiresPhp('8.1')]
    public function testRegisterWithEnvironmentProd(): void
    {
        @runkit_constant_redefine('YII_ENV', 'prod');

        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapAsset::class));
        $this->assertSame(
            [
                '/55145ba9/bootstrap.min.css' => ['/55145ba9/bootstrap.min.css'],
            ],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css.map');

        @runkit_constant_redefine('YII_ENV', 'test');
    }
}
