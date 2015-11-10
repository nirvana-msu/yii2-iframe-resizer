<?php
/**
 * @link https://github.com/nirvana-msu/yii2-iframe-resizer
 * @copyright Copyright (c) 2015 Alexander Stepanov
 * @license MIT
 */

namespace nirvana\iframeresizer;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use DOMDocument;

/**
 * IFrameResizer provides convenient shortcut methods allowing to embed iframeResizer.contentWindow.min.js file inside iFrames.
 * You should either call `widget` static method as usual, which will embed javascript into the page response,
 * or call `embed` static method to embed script into an existing iFrame HTML content generated elsewhere.
 *
 * @author Alexander Stepanov <student_vmk@mail.ru>
 */
class IFrameResizer extends Widget
{
    /**
     * Executes the widget.
     * You should call ::widget() if you need to embed iframeResizer.contentWindow.min.js
     * into the page response, i.e. page itself will be served as iFrame.
     */
    public function run()
    {
        $url = $this->getScriptUrl();
        $this->view->registerJsFile($url);
    }

    /**
     * This method should be used if you need to embed iframeResizer.contentWindow.min.js
     * into an existing iFrame HTML content generated elsewhere.
     * @param $html string iFrame HTML code where script needs to be embedded
     * @return string iFrame HTML code with embedded script
     * @throws InvalidConfigException
     */
    public static function embed($html)
    {
        $config['class'] = IFrameResizer::className();
        $widget = Yii::createObject($config);
        /* @var $widget IFrameResizer */

        $url = $widget->getScriptUrl();
        $scriptTag = Html::jsFile($url);

        // Embed script into existing HTML before closing </body> tag
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $body = $dom->getElementsByTagName('body')->item(0);
        $script = $dom->createDocumentFragment();
        $script->appendXML($scriptTag);
        $body->appendChild($script);

        return $dom->saveHTML();
    }

    /**
     * Publishes js which needs to be embedded in an iFrame
     * @return string url for published js that needs to be registered
     * @throws InvalidConfigException
     */
    public function getScriptUrl()
    {
        $contentWindowJS = YII_DEBUG ? 'iframeResizer.contentWindow.js' : 'iframeResizer.contentWindow.min.js';
        $assetManager = $this->view->getAssetManager();
        $assetBundle = $assetManager->getBundle(IFrameResizerAsset::className());   // this does the publishing
        return $assetManager->getAssetUrl($assetBundle, $contentWindowJS);
    }
}
