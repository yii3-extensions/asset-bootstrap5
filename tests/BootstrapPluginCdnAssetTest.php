<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use Yii\Asset\BootstrapPluginCdnAsset;
use Yii\Asset\Tests\Support\TestSupport;
use Yiisoft\Assets\Exception\InvalidConfigException;

final class BootstrapPluginCdnAssetTest extends \PHPUnit\Framework\TestCase
{
    use TestSupport;

    /**
     * @throws InvalidConfigException
     */
    public function testRegister(): void
    {
        $this->assertFalse($this->assetManager->isRegisteredBundle(BootstrapPluginCdnAsset::class));

        $this->assetManager->register(BootstrapPluginCdnAsset::class);

        $this->assertTrue($this->assetManager->isRegisteredBundle(BootstrapPluginCdnAsset::class));
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
