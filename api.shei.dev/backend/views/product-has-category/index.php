<?php

use common\models\Product_has_category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Product_has_category_s $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Product Has Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-has-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Has Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'category_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product_has_category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id, 'category_id' => $model->category_id]);
                 }
            ],
        ],
    ]); ?>


</div>
