<?php
use yii\bootstrap5\Modal;
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

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

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
    <?php
    $pictures = $model->getPictures()->all();

    ?>
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
            [
                'label' => 'Pictures',
                'value' => function ($model) use ($pictures) {
                    if (!empty($pictures)) {
                        // Get the URL of the first picture
                        $firstPictureUrl = Yii::getAlias('@web/uploads/') . $pictures[0]->imageURL;

                        // Generate the HTML for the clickable thumbnail to open the modal
                        $thumbnailHtml = Html::a(
                            Html::img($firstPictureUrl, ['width' => '100']),
                            'javascript:void(0);',
                            [
                                'onclick' => "$('#property-picture-modal').modal('show');",
                                // JavaScript to open the modal
                                'class' => 'thumbnail',
                            ]
                        );

                        // Generate the HTML for the modal structure
                        $modalHtml = '<div id="property-picture-modal" class="modal fade">';
                        $modalHtml .= '<div class="modal-dialog modal-lg">';
                        $modalHtml .= '<div class="modal-content">';

                        // Add the modal title
                        $modalHtml .= '<div class="modal-header">';
                        $modalHtml .= '<h5 class="modal-title">Property Pictures</h5>';
                        $modalHtml .= '<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>';
                        $modalHtml .= '</div>';

                        // Generate the HTML for the carousel
                        $carouselHtml = '<div id="property-picture-carousel" class="carousel slide" data-ride="carousel">';
                        $carouselHtml .= '<div class="carousel-inner">';

                        foreach ($pictures as $index => $picture) {
                            $imageUrl = Yii::getAlias('@web/uploads/') . $picture->imageURL;
                            $itemClass = ($index === 0) ? 'active' : ''; // Add 'active' class to the first picture item
                
                            $carouselHtml .= '<div class="item ' . $itemClass . '">';
                            $carouselHtml .= Html::img($imageUrl, ['width' => '100%']);
                            $carouselHtml .= '</div>';
                        }

                        $carouselHtml .= '</div>';

                        // Add the carousel controls
                        $carouselHtml .= '<a class="carousel-control-prev" href="#property-picture-carousel" role="button" data-slide="prev">';
                        $carouselHtml .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        $carouselHtml .= '<span class="sr-only">Previous</span>';
                        $carouselHtml .= '</a>';
                        $carouselHtml .= '<a class="carousel-control-next" href="#property-picture-carousel" role="button" data-slide="next">';
                        $carouselHtml .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        $carouselHtml .= '<span class="sr-only">Next</span>';
                        $carouselHtml .= '</a>';

                        // Close the carousel div
                        $carouselHtml .= '</div>';

                        // End the modal content and dialog
                        $modalHtml .= $carouselHtml;
                        $modalHtml .= '</div>';
                        $modalHtml .= '</div>';
                        $modalHtml .= '</div>';

                        // Return the HTML
                        return $thumbnailHtml . $modalHtml;
                    } else {
                        return 'No pictures available';
                    }
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>