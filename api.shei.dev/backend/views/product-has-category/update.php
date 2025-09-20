<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product_has_category $model */

$this->title = 'Update Product Has Category: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Product Has Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'category_id' => $model->category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-has-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
