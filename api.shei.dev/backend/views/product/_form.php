<?php

use common\models\Product_has_category;
use common\models\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    

    <?= Upload::render_input_upload($form, $model, 'temp'); ?>

    <?= $form->field($model, 'order_show')->textInput() ?>


    <?php
    $pre_selected = [];
    foreach(Product_has_category::find()->where(['product_id'=>$model->id])->all() as $pc){
        $pre_selected[]= $pc->category_id;
    }
    $model->category_id =  $pre_selected;
    ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        \common\models\Product_category::find()
            ->select(['name', 'id'])   // id = value, name = label
            ->indexBy('id')            // makes array keys = id
            ->column(),                  // items from Category model
        [
            'multiple' => true,           // enable multiple select
            'class' => 'form-control',    // bootstrap styling
            'size' => 5,
        ] // first empty option
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>




    <?php ActiveForm::end(); ?>

</div>