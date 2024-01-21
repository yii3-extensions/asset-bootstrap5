<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

use function defined;

/**
 * Twitter Bootstrap 5 JavaScript bundle.
 */
final class BootstrapPluginAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/bootstrap/dist/js';
    public array $depends = [BootstrapAsset::class];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $environment = defined('YII_ENV') ? YII_ENV : 'prod';
        $jsFiles = $environment === 'prod' ? 'bootstrap.bundle.min.js' : 'bootstrap.bundle.js';

        $this->js = [$jsFiles];
        $this->publishOptions = [
            'filter' => $pathMatcher->only("**/js/{$jsFiles}", "**/js/{$jsFiles}.map"),
        ];
    }
}
