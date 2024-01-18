<?php

declare(strict_types=1);

namespace Yii\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

use function array_merge;

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
        $filesPattern = YII_ENV === 'prod' ? ['**/css/bootstrap.min.css'] : ['**/css/bootstrap.css'];
        $filesMap = YII_ENV === 'prod' ? ['**/css/bootstrap.min.css.map'] : ['**/css/bootstrap.css.map'];
        $files = array_merge($filesPattern, $filesMap);

        $pathMatcher = new PathMatcher();

        $this->css = [YII_ENV === 'prod' ? 'bootstrap.min.css' : 'bootstrap.css'];
        $this->publishOptions = ['filter' => $pathMatcher->only(...$files)];
    }
}
