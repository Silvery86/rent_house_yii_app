<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Property $model */

$this->title = $model->propertyID;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="property-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'propertyID' => $model->propertyID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'propertyID' => $model->propertyID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'propertyID',
            'address',
            'bedrooms',
            'bathrooms',
            'squareFootage',
            'amenities',
            'monthlyRent',
            'deposit',
            'availabilityStatus',
            'propertyType',
        ],
    ]) ?>

</div>
