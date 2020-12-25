<?php
namespace sangroya\ckeditor5;
use yii\web\AssetBundle;

class Assets extends AssetBundle
{

    public $css = [
    ];

    public $js = [
        'https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js',
    ];

    public $depends = [
    ];
}