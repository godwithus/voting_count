<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<center>
    <br><br>
<div class="site-login" style="background-color: rgba(125,125,29,0.2); padding: 20px; border: 5px dotted #cccccc; border-radius: 10px; width: 500px;">
    <div style="font-size: 40px;">Vote Count</div>
    <i> Vote Count Collation</i> <br><br>
    <?php $form = ActiveForm::begin(); ?>

        <div style="width: 300px;">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="form-group">
            <div>
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
            </div>
            <br>
            <p><b>password & username</b>   
                <i>* admin - admin, * demo - demo</i>
            </p>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</center>
