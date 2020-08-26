<?php

if (Yii::$app->user->isGuest) {
    Yii::$app->response->redirect(['site/login']);
}

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>You Are Welcome!</h1>

        <p class="lead">Get Started! Get the Voting Result</p>

        <p><a class="btn btn-lg btn-success" href="/polling-unit/index">Check Polling Result</a></p>
    </div>
</div>
