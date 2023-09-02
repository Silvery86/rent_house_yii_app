<?php
use yii\helpers\Html;
use yii\rbac\Role;
use yii\rbac\Permission;
?>
<div  class="w-100 flex text-center">

    <h2>User Details Dash</h2>
    <?php if ($user !== null): ?>
        <p>Name: <?= Html::encode($user->fullname) ?></p>
        <p>Email: <?= Html::encode($user->email) ?></p>
        <p>Name: <?= Html::encode($user->id) ?></p>
        <?php 
        $authManager = Yii::$app->authManager;
        print_r($authManager);
        ?>
        <!-- Display other user details as needed -->
    <?php else: ?>
        <p>User data not available.</p>
    <?php endif; ?>
   
</div>