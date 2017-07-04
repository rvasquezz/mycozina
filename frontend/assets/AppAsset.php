<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
 public $sourcePath = '@app/themes/plantilla';

    public $css = [
        'css/animate.css',
        'css/animate.min.css',
        'css/animsition.min.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/style.css',
        'css/style.min.css'

    ];
    public $js = [
        'js/animsition.min.js',
        'js/bootstrap-slider.min.js',
        'js/bootstrap.min.js',
        'js/foodpicky.js',
        'js/foodpicky.min.js',
        'js/headroom.js',
        'js/headroom.min.js',
        'js/infobox_packed.js',
        'js/infobox_packed.min.js',
        'js/jquery-ui.min.js',
        'js/jquery.googlemap.js',
        'js/jquery.googlemap.min.js',
        'js/jquery.isotope.min.js',
        'js/jquery.min.js',
        'js/jQuery-2.1.4.min.js',
        'js/mapbox.js',
        'js/markerclusterer.js',
        'js/markerclusterer.min.js',
        'js/tether.min.js'

    ];
    public $depends = [
        // 'yii\web\YiiAsset',
    ];
}
