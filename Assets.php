<?php
namespace sangroya\ckeditor5;
use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    public $sourcePath = '@vendor/sangroya/yii2-ckeditor5/assets/';
    public $css = [
    ];

    public $js = [
        'ckeditor.js',
        'ckeditor-collection.js'
    ];

    public $depends = [
    ];
}