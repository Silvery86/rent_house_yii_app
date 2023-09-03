<?php
use app\models\Picture;
use app\models\Property;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Property $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="property-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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
    <!-- Add the image upload field -->
    <div class="form-group">
        <label for="existing-images">Existing Images</label>
        <div id="existing-images" class="row border border-dark p-1 mb-4">
            <?php
            $imagePaths = [];
            if ($model->propertyID) {
                $imagePaths = Picture::getImagePathsByPropertyID($model->propertyID);
            }

            $existingImagesHtml = '';

            foreach ($imagePaths as $imagePath) {
                // Convert the local file path to a URL
                $imageUrl = Yii::getAlias('@web/uploads/') . basename($imagePath);
                $existingImagesHtml .= Html::img($imageUrl, ['class' => 'img-responsive']);
                ?>
                <div class="col-md-3"> <!-- Adjust the column size as needed -->
                    <div class="position-relative">
                        <img src="<?= $imageUrl ?>" class="img-fluid"  alt="Image">
                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#removeImageModal">Remove</button>
                    </div>
                </div>
                <?php

            }

            ?>
        </div>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- Modal for image removal confirmation -->
<!-- Modal for image removal confirmation -->
<div class="modal fade" id="removeImageModal" tabindex="-1" aria-labelledby="removeImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeImageModalLabel">Remove Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this image?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveButton">Remove</button>
            </div>
        </div>
    </div>
</div>

<script>
    var imageUrlToRemove; // Variable to store the image URL to remove

    function removeImage(button, imageUrl) {
        imageUrlToRemove = imageUrl; // Store the image URL in the variable
        $('#removeImageModal').modal('show'); // Show the confirmation modal
    }

    document.getElementById('confirmRemoveButton').addEventListener('click', function () {
        // Add logic here to remove the image from the database using the imageUrlToRemove
        // You may need to make an AJAX request to a Yii action to perform the removal

        // After successful removal, you can remove the image container from the DOM
        var imageContainer = document.querySelector('img[src="' + imageUrlToRemove + '"]').closest('.col-md-3');
        imageContainer.remove();

        $('#removeImageModal').modal('hide'); // Close the confirmation modal
    });
</script>