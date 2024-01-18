<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

use function array_merge;

/**
 * Twitter Bootstrap 5 JavaScript bundle.
 */
final class BootstrapPluginAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/bootstrap/dist/js';
    public array $depends = [BootstrapAsset::class];
    public array $js = [YII_ENV === 'prod' ? 'bootstrap.bundle.min.js' : 'bootstrap.bundle.js'];

    public function __construct()
    {
        $filesPattern = YII_ENV === 'prod' ? ['**/js/bootstrap.bundle.min.js'] : ['**/js/bootstrap.bundle.js'];
        $filesMap = YII_ENV === 'prod' ? ['**/js/bootstrap.bundle.min.js.map'] : ['**/js/bootstrap.bundle.js.map'];

        $pathMatcher = new PathMatcher();

        $this->publishOptions = ['filter' => $pathMatcher->only(...array_merge($filesPattern, $filesMap))];
    }
}
