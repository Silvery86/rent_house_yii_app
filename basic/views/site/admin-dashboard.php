<?php
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->session->get('user');

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <div class="row">
        <!-- Left Side: 3 columns width -->
        <div class="col-md-3">
            <?php if ($user !== null): ?>
                <p>Welcome,
                    <?= Html::encode($user->fullname) ?>
                </p>
                <div class="list-group">
                    <a href="#" class="list-group-item" data-content="user-details">User Details</a>
                    <?php if (Yii::$app->user->can('admin')): ?>
                        <a href="#" class="list-group-item" data-content="index">User Management</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>User data not available in session.</p>
            <?php endif; ?>
        </div>

        <!-- Right Side: 9 columns width -->
        <div class="col-md-9">
            <div id="content-placeholder">
                <!-- Content based on chosen option will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery is assumed to be available for simplicity
    $(document).ready(function () {
        // Handle click on options
        $(".list-group-item").click(function (e) {
            e.preventDefault();

            var contentToLoad = $(this).data("content");

            // Load content based on chosen option
            if (contentToLoad === "user-details") {
                var userDetailsUrl = '<?= \yii\helpers\Url::toRoute(['dashboard/user-details']) ?>';

                $.ajax({
                    url: userDetailsUrl, // Specify the URL of the content file
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        $("#content-placeholder").html(data);
                    },
                    error: function () {
                        $("#content-placeholder").html("<p>Error loading content.</p>");
                    }
                });
            }

            if (contentToLoad === "index") {
                var userDetailsUrl = '<?= \yii\helpers\Url::toRoute(['dashboard/index']) ?>';
                $.ajax({
                    url: userDetailsUrl, // Specify the URL of the content file
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        $("#content-placeholder").html(data);
                    },
                    error: function () {
                        $("#content-placeholder").html("<p>Error loading content.</p>");
                    }
                });
            }

        });
    });
</script>