<?php
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Rent House App';
?>
<div class="property-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>






    <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <?php foreach ($availableProperty as $key => $property): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key ?>" <?php if ($key === 0) echo 'class="active"' ?>
                aria-label="Slide <?= $key + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($availableProperty as $key => $property): ?>
            <div class="carousel-item <?php if ($key === 0) echo 'active' ?>">
                <?php if (!empty($property->pictures) && isset($property->pictures[0])): ?>
                    <?php $firstPicture = $property->pictures[0]; ?>
                    <img src="<?= Yii::getAlias('@web/uploads/') . $firstPicture->imageURL ?>" class="d-block w-100" alt="<?= Html::encode($property->address) ?>" style="height: 50vh; object-fit: cover;">
                <?php else: ?>
                    <!-- Handle case where there are no pictures -->
                    <img src="<?= Yii::getAlias('@web/uploads/house1.jpg') ?>" class="d-block w-100" alt="No Image" style="height: 50vh; object-fit: cover;">
                <?php endif; ?>

                <div class="carousel-caption d-none d-md-block">
                    <h5>
                        <?= Html::encode($property->address) ?>
                    </h5>
                    <p>
                        <?= Html::encode($property->monthlyRent) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


</div>