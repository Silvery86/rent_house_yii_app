<?php

use app\models\Property;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PropertySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'propertyID',
            'address',
            'bedrooms',
            'bathrooms',
            'squareFootage',
            'amenities',
            'monthlyRent',
            'deposit',
            'availabilityStatus',
            [
                'label' => 'Picture',
                'value' => function ($model) {
                    $pictures = $model->getPictures()->all(); // Assuming the pictures relation is named "pictures"
                    if (!empty($pictures)) {
                        $firstPicture = $pictures[0] -> imageURL;
                        $imageUrl = Yii::getAlias('@web/uploads/') . $firstPicture;
                        
                        return Html::a(Html::img($imageUrl, ['width' => '100']), $imageUrl, ['target' => '_blank']);
                    } else {
                        return 'No pictures available';
                    }
                },
                'format' => 'raw',
            ],
            'propertyType',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Property $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'propertyID' => $model->propertyID]);
                 }
            ],
        ],
    ]); ?>


</div>
