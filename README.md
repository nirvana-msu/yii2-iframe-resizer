yii2-iframe-resizer
================

Yii2 extension for javascript-based [iframe-resizer](https://github.com/davidjbradshaw/iframe-resizer). It enables automatic resizing of height and width of both same and cross domain iFrames to fit their contained content, provided that you have control of pages both serving and hosting iFrames.

## Resources
 * Yii2 [extension page](http://www.yiiframework.com/extension/yii2-iframe-resizer)
 * iFrame Resizer library [documentation](https://github.com/davidjbradshaw/iframe-resizer)

## Installation

### Composer

Add extension to your `composer.json` and update your dependencies as usual, e.g. by running `composer update`
```js
{
    "require": {
        "nirvana-msu/yii2-iframe-resizer": "1.0.*@dev"
    }
}
```
##Sample Usage

###Page Serving iFrame
You need to embed one of the library scripts into the iFrame. Extension provides two shortcuts for doing this, depending on your use-case.

* If the rendered page itself is served as an iFrame content, simply register `IFrameResizer` widget in your view:
```php
IFrameResizer::widget();
```

* If you need to embed the script into existing iFrame HTML code generated elsewhere, there is a convinient shortcut you can use to inject the script before closing `</body>` tag:
```php
$injectedHtml = IFrameResizer::embed($html);
```

###Page Hosting iFrame
First, register `IFrameResizerAsset` bundle:
```php
IFrameResizerAsset::register($this);
```

Finally, call the library to enable dynamic resizing. As described in the [documentation](http://davidjbradshaw.github.io/iframe-resizer/), you can do this by either using **native** JavaScript:
```js
var iframes = iFrameResize( [{options}], [css selector] || [iframe] );
```
or via **jQuery**:
```js
$('iframe').iFrameResize( [{options}] );
```
Note that **jQuery** is not specified as a dependency for this extension, since you may choose to use **native** version instead. Therefore if you want to use **jQuery**, make sure it is registered in your view.

##License

Extension is released under MIT license, same as underlying iFrame Resizer library.
