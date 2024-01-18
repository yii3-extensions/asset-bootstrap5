<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use Yii\Asset\BootstrapAsset;
use Yii\Asset\BootstrapCdnAsset;
use Yii\Asset\BootstrapPluginAsset;
use Yii\Asset\BootstrapPluginCdnAsset;
use Yii\Asset\Tests\Support\TestTrait;
use Yiisoft\Assets\AssetBundle;

final class AssetTest extends \PHPUnit\Framework\TestCase
{
    use TestTrait;

    public function testBootstrapAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapAsset::class));
        $this->assertSame(
            ['/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css']],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css.map');
    }

    public function testBootstrapCdnAssetRegister(): void
    {
        $assetManager = $this->assetManager;

        $this->assertFalse($assetManager->isRegisteredBundle(BootstrapCdnAsset::class));

        $assetManager->register(BootstrapCdnAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $assetManager->getBundle(BootstrapCdnAsset::class));
        $this->assertSame(
            [
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' => [
                    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
                    'crossorigin' => 'anonymous',
                    'integrity' => 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
                    'rel' => 'stylesheet',
                ],
            ],
            $assetManager->getCssFiles()
        );
    }

    public function testBootstrapPluginAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $this->assertSame(
            ['/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css']],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.css.map');
        $this->assertSame(
            ['/16b8de20/bootstrap.bundle.js' => ['/16b8de20/bootstrap.bundle.js']],
            $this->assetManager->getJsFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.js');
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.js.map');
    }

    public function testBootstrapPluginCdnAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginCdnAsset::class));

        $this->assetManager->register(BootstrapPluginCdnAsset::class);

        $this->assertSame(
            [
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' => [
                    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
                    'crossorigin' => 'anonymous',
                    'integrity' => 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
                    'rel' => 'stylesheet',
                ],
            ],
            $this->assetManager->getCssFiles()
        );
        $this->assertSame(
            [
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' => [
                    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
                    'crossorigin' => 'anonymous',
                    'integrity' => 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
                ],
            ],
            $this->assetManager->getJsFiles()
        );
    }

    /**
     * @requires PHP 8.1
     *
     * @depends testBootstrapAssetRegister
     * @depends testBootstrapCdnAssetRegister
     * @depends testBootstrapPluginAssetRegister
     * @depends testBootstrapPluginCdnAssetRegister
     */
    public function testProdBootstrapAssetRegister(): void
    {
        @runkit_constant_redefine('YII_ENV', 'prod');

        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapAsset::class));
        $this->assertSame(
            ['/55145ba9/bootstrap.min.css' => ['/55145ba9/bootstrap.min.css']],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css.map');
    }

    /**
     * @requires PHP 8.1
     *
     * @depends testBootstrapAssetRegister
     * @depends testBootstrapCdnAssetRegister
     * @depends testBootstrapPluginAssetRegister
     * @depends testBootstrapPluginCdnAssetRegister
     */
    public function testProdBootstrapPluginAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $this->assertSame(
            ['/55145ba9/bootstrap.min.css' => ['/55145ba9/bootstrap.min.css']],
            $this->assetManager->getCssFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css');
        $this->assertFileExists(__DIR__ . '/Support/runtime/55145ba9/bootstrap.min.css.map');
        $this->assertSame(
            ['/16b8de20/bootstrap.bundle.min.js' => ['/16b8de20/bootstrap.bundle.min.js']],
            $this->assetManager->getJsFiles()
        );
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js');
        $this->assertFileExists(__DIR__ . '/Support/runtime/16b8de20/bootstrap.bundle.min.js.map');
    }
}
