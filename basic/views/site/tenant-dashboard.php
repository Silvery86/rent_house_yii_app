<?php
use yii\helpers\Html;

$user = Yii::$app->session->get('user');

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if ($user !== null): ?>
        <p>Welcome, <?= Html::encode($user->fullname) ?></p>
        <p>Username: <?= Html::encode($user->username) ?></p>
        <!-- Display other user-specific information -->
    <?php else: ?>
        <p>User data not available in session.</p>
    <?php endif; ?>
</div>
