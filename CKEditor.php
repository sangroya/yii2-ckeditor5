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

    public $clientOptions = [
        'language'=> 'au'

    ];

    public $preset='standard';

    protected $toolbars=[
        "standard"=>[
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'indent',
            'outdent',
            '|',
            'imageUpload',
            'blockQuote',
            'insertTable',
            'mediaEmbed',
            'undo',
            'redo',
        //    'exportPdf',
         //   'exportWord',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            'highlight',
            'imageInsert',
            'alignment'

        ],
        'basic'=>[
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'indent',
            'outdent',
            '|',
            'blockQuote',
            'insertTable',
            'mediaEmbed',
            'undo',
            'redo',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            'highlight',
            'alignment'

     ]
        ];
    
    public $toolbarKey='standard';
    public $toolbar=  null;
    public $uploadUrl;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->toolbarKey=isset($this->toolbars[$this->preset])?$this->preset:'standard';
        if($this->toolbar==null)
         $this->toolbar=  [
            'items' => $this->toolbars[$this->toolbarKey]
        ];
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
        $this->registerAssets($this->getView());
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
             "ClassicEditor.create( document.querySelector( '#{$this->options['id']}' ), {$clientOptions} ).then( editor=>{console.log( editor );
      
                CKEditor.set('{$this->options['id']}',editor);
           
            }).catch( error => {console.error( error );} );"

        );
        $replacejs = new JsExpression(
            
            "CKEditor.replace=(element)=>{
                ClassicEditor.create( document.querySelector( '#'+element ), {$clientOptions} ).then( editor=>{
               CKEditor.set(element,editor);
           
           }).catch( error => {console.error( error );} );}"

       );
        $this->view->registerJs($js);
        $this->view->registerJs($replacejs);
    }

    protected function registerAssets($view)
    {
        Assets::register($view);
    }
}
