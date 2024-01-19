<?php

declare(strict_types=1);

namespace Yii\Asset\Tests;

use Yii\Asset\BootstrapCdnAsset;
use Yii\Asset\Tests\Support\TestTrait;
use Yiisoft\Assets\AssetBundle;

final class BootstrapCdnAssetTest extends \PHPUnit\Framework\TestCase
{
    use TestTrait;

    public function testRegister(): void
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
}
