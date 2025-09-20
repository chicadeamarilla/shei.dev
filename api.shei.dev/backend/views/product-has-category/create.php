<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product_has_category $model */

$this->title = 'Create Product Has Category';
$this->params['breadcrumbs'][] = ['label' => 'Product Has Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-has-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
