<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Property $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'propertyID')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bedrooms')->textInput() ?>

    <?= $form->field($model, 'bathrooms')->textInput() ?>

    <?= $form->field($model, 'squareFootage')->textInput() ?>

    <?= $form->field($model, 'amenities')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monthlyRent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'availabilityStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'propertyType')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
