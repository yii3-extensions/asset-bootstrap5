<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Twitter Bootstrap 5 CDN CSS bundle.
 */
final class BootstrapCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $css = ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'];
    public array $cssOptions = [
        'crossorigin' => 'anonymous',
        'integrity' => 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
        'rel' => 'stylesheet',
    ];
}
