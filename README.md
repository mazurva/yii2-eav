EAV Dynamic Attributes for Yii2
========

[![Build Status](https://travis-ci.org/mazurva/yii2-eav.svg?branch=master)](https://travis-ci.org/mazurva/yii2-eav)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

``` sh
php composer.phar require --prefer-dist mazurva/yii2-eav "dev-master"
```

or add

```
"mazurva/yii2-eav": "dev-master"
```

to the require section of your `composer.json` file.

``` sh
php yii migrate/up --migrationPath=@vendor/mazurva/yii2-eav/src/migrations
```

Usage
-----
Attach to your model
```php
  use EavTrait; // need for full support label of fields

  public function behaviors()
  {
      return [
          'eav' => [
              'class' => mazurva\eav\EavBehavior::className(),
              'valueClass' => mazurva\eav\models\EavAttributeValue::className(), // this model for table object_attribute_value
          ]
      ];
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEavAttributes()
  {
      return $this->hasMany(mazurva\eav\models\EavAttribute::className(), ['categoryId' => 'id']);
  }
```

Sample use in view:

```php
<?=$form->field($model,'eav2'); ?>
```

or

```php
foreach($model->eavAttributes as $attr){
    echo $form->field($model, $attr->name)->textInput();
}
```

Add new field:

```php
$attr = new mazurva\eav\models\EavAttribute();
$attr->attributes = [
        'categoryId' => 1, // Category ID
        'name' => 'AttrCategory1',  // service name field
        'label' => 'Attr1',         // label text for form
        'defaultValue' => 'attr1',  // default value
        'entityModel' => SampleModel::className(), // work model
        'required'=>false           // add rule "required field"
    ];
$attr->save();
```