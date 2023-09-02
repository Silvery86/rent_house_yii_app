<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PropertySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="property-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'propertyID') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'bedrooms') ?>

    <?= $form->field($model, 'bathrooms') ?>

    <?= $form->field($model, 'squareFootage') ?>

    <?php // echo $form->field($model, 'amenities') ?>

    <?php // echo $form->field($model, 'monthlyRent') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'availabilityStatus') ?>

    <?php // echo $form->field($model, 'propertyType') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
