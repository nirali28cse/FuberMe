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
class FuberMeAsset  extends AssetBundle
{
  

	// public $basePath = '@webroot';
	// public $baseUrl = '@web';
	

    public $sourcePath = '@bower/fuberme/';
	
	
	public $jsOptions = array(
		'position' => \yii\web\View::POS_HEAD
	);
	
    public $css = [	    
	    'css/bootstrap.css',
		'css/style.css',
        'css/fontAladin.css',
        'css/fontMontserrat.css',
        'css/fontPlayfair.css',
        'css/megamenu.css',
        'css/etalage.css',        
        'css/form.css',
        'css/jquery-ui.css',
    ];
    public $js = [
	//	'js/jquery.easydropdown.js',
	//	'js/jquery.etalage.min.js',		
	//	'js/jquery.jscrollpane.min.js',
		'js/jquery-1.11.1.min.js',
		// 'js/megamenu.js',
		'js/menu_jquery.js',
		'js/responsiveslides.min.js',
		'js/simpleCart.min.js',
		'js/jquery.flexisel.js',
    ];
	
	
/*     public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ]; */

}
