<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Twitter Bootstrap 5 CSS bundle.
 */
final class BootstrapAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/bootstrap/dist/css';

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $environment = defined('YII_ENV') ? YII_ENV : 'prod';
        $cssFiles = $environment === 'prod' ? 'bootstrap.min.css' : 'bootstrap.css';

        $this->css = [$cssFiles];
        $this->publishOptions = ['filter' => $pathMatcher->only("**/css/{$cssFiles}", "**/css/{$cssFiles}.map")];
    }
}
