<?php

namespace sangroya\ckeditor5;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * CKEditor renders a CKEditor5 js plugin for classic editing.
 * @author Parveen Sangroya <parveen0013@gmail.com>
 * @package sangroya\ckeditor5
 */
class CKEditor extends InputWidget
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerPlugin();
    }

    /**
     * Registers CKEditor plugin
     */
    protected function registerPlugin()
    {
        if (!empty($this->toolbar)) {
            $this->clientOptions['toolbar'] = $this->toolbar;
        }
        if (!empty($this->uploadUrl)) {
            $this->clientOptions['ckfinder'] = ['uploadUrl' => $this->uploadUrl];
        }
        $clientOptions = Json::encode($this->clientOptions);

        $js = new JsExpression(
            $this->editorType . "Editor.create( document.querySelector( '#{$this->options['id']}' ), {$clientOptions} ).catch( error => {console.error( error );} );"
        );
        $this->view->registerJs($js);
    }

    protected function registerAssets($view)
    {
        Assets::register($view);
    }
}
