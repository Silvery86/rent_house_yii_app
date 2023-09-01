<?php
use yii\helpers\Html;
?>
<h2>User Details</h2>
<?php if ($user !== null): ?>
    <p>Name: <?= Html::encode($user->fullname) ?></p>
    <p>Email: <?= Html::encode($user->email) ?></p>
    <!-- Display other user details as needed -->
<?php else: ?>
    <p>User data not available.</p>
<?php endif; ?>