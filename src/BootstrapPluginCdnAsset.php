<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Twitter Bootstrap 5 CDN JavaScript bundle.
 */
final class BootstrapPluginCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'];
    public array $jsOptions = [
        'crossorigin' => 'anonymous',
        'integrity' => 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
    ];
    public array $depends = [BootstrapCdnAsset::class];
}
