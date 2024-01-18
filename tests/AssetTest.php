<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use PHPForge\Support\Assert;
use Yii\Asset\BootstrapAsset;
use Yii\Asset\BootstrapCdnAsset;
use Yii\Asset\BootstrapPluginAsset;
use Yii\Asset\BootstrapPluginCdnAsset;
use Yii\Asset\Tests\Support\TestTrait;
use Yiisoft\Assets\AssetBundle;

final class AssetTest extends \PHPUnit\Framework\TestCase
{
    use TestTrait;

    public function testBootstrapAssetSimpleDependency(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertTrue($this->assetManager->isRegisteredBundle(BootstrapAsset::class));
    }

    public function testBootstrapAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapAsset::class));

        $this->assetManager->register(BootstrapAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapAsset::class));
        $this->assertSame(
            ['/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css']],
            $this->assetManager->getCssFiles()
        );
    }

    public function testBootstrapCdnAssetSimpleDependency(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapCdnAsset::class));

        $this->assetManager->register(BootstrapCdnAsset::class);

        $this->assertTrue($this->assetManager->isRegisteredBundle(BootstrapCdnAsset::class));
    }

    public function testBootstrapCdnAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapCdnAsset::class));

        $this->assetManager->register(BootstrapCdnAsset::class);

        $this->assertInstanceOf(AssetBundle::class, $this->assetManager->getBundle(BootstrapCdnAsset::class));
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
    }

    public function testBootstrapPluginAssetSimpleDependency(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $registerBundle = Assert::inaccessibleProperty($this->assetManager, 'registeredBundles');

        $this->assertCount(2, $registerBundle);
        $this->assertArrayHasKey(BootstrapAsset::class, $registerBundle);
        $this->assertArrayHasKey(BootstrapPluginAsset::class, $registerBundle);
        $this->assertInstanceOf(AssetBundle::class, $registerBundle[BootstrapAsset::class]);
    }

    public function testBootstrapPluginAssetRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginAsset::class));

        $this->assetManager->register(BootstrapPluginAsset::class);

        $this->assertSame(
            ['/55145ba9/bootstrap.css' => ['/55145ba9/bootstrap.css']],
            $this->assetManager->getCssFiles()
        );
        $this->assertSame(
            ['/16b8de20/bootstrap.bundle.js' => ['/16b8de20/bootstrap.bundle.js']],
            $this->assetManager->getJsFiles()
        );
    }

    public function testBootstrapPluginCdnAssetSimpleDependency(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginCdnAsset::class));

        $this->assetManager->register(BootstrapPluginCdnAsset::class);

        $registerBundle = Assert::inaccessibleProperty($this->assetManager, 'registeredBundles');

        $this->assertCount(2, $registerBundle);
        $this->assertArrayHasKey(BootstrapCdnAsset::class, $registerBundle);
        $this->assertArrayHasKey(BootstrapPluginCdnAsset::class, $registerBundle);
        $this->assertInstanceOf(AssetBundle::class, $registerBundle[BootstrapCdnAsset::class]);
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
}
