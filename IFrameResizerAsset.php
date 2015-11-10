<?php
/**
 * @link https://github.com/nirvana-msu/yii2-iframe-resizer
 * @copyright Copyright (c) 2015 Alexander Stepanov
 * @license MIT
 */

namespace nirvana\iframeresizer;

use Yii;
use yii\web\AssetBundle;

/**
 * Asset bundle that needs to be registered in the page hosting an iFrame.
 * This bundle is also used to publish (but not register) js that needs to be embedded into an iFrame.
 *
 * @author Alexander Stepanov <student_vmk@mail.ru>
 */
class IFrameResizerAsset extends AssetBundle
{
    public $sourcePath = '@bower/iframe-resizer/js';
    public $css = [];
    public $js = [  // Configured conditionally (source/minified) during init()
    ];
    public $depends = [];   // There's a native version as well, so jQuery dependency is not specified by default

    public function init()
    {
        parent::init();
        $this->js[] = YII_DEBUG ? 'iframeResizer.js' : 'iframeResizer.min.js';
    }
}
