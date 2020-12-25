yii2-ckeditor5
==============
CKEditor for Yii

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sangroya/yii2-ckeditor5 "*"
```

or add

```
"sangroya/yii2-ckeditor5": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use sangroya\ckeditor5\CKEditor;


<?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
       
    ]) ?>```