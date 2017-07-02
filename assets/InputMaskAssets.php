<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InputMaskAssets extends AssetBundle
{

    public function init()
    {
        parent::init();
        $this->jsOptions['position'] = \yii\web\View::POS_END;
    }

    public $sourcePath = '@bower/admin-lte/';
    public $baseUrl = '@web';
    
    public $js = [
        'plugins/input-mask/jquery.inputmask.js',
        'plugins/input-mask/jquery.inputmask.date.extensions.js',
    ];
    
    public $depends = [
        //'\app\assets\AppAsset',
    ];

}
