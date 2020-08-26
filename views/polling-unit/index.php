<?php
/* JESUS Phil 2:9-11 */

if (Yii::$app->user->isGuest) {
      Yii::$app->response->redirect(['site/login']);
}


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States; 
use app\models\Lga; 
use app\models\Ward;
use app\models\PollingUnit;


/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */
/* @var $form ActiveForm */
?>
<div class="polling-unit-index">

<center class="well well-sm" style="background-color: #f1f1f1">
    <h1>Result From Polling Unit</h1>
</center>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($state, 'state_id')->dropDownList(States::stateAll(),
                [
                    'prompt'=>'Select State',
                    'onchange'=>'

                        $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-lga?id=').'"+$(this).val(),

                        function(data){
                            $("select[id=pollingunit-lga_id]").html("<option value=\"\">--Select LGA--</option>"+data);
                        });',
                ]
            );
        ?>

        <?= $form->field($model, 'lga_id')->dropDownList(Lga::lgaAll(),
                    [
                        'multiple' => false,
                        'onchange'=>'

                            $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-ward?id=').'"+$(this).val(),

                            function(data){
                                $("select[id=pollingunit-ward_id]").html("<option value=\"\">--Select Ward Name--</option>"+data);
                            });',
                ]
            );
        ?>

        <?= $form->field($model, 'ward_id')->dropDownList(Ward::wardAll(),
                    [
                        'multiple' => false,
                        'onchange'=>'

                            $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-polling-unit?id=').'"+$(this).val(),

                            function(data){
                                $("select[id=pollingunit-uniqueid]").html("<option value=\"\">--Select Polling Unit--</option>"+data);
                            });',
                ]
            );
        ?>

        <?= $form->field($model, 'uniqueid')->dropDownList(PollingUnit::pollingAll(),
                [
                    'multiple' => false,
                    'onchange'=>'

                        $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-polling-unit-name?id=').'"+$(this).val(),

                        function(data){
                            $("div[id=ourResult]").html(data);
                        });',
                ]
            );
        ?>

        <!-- <h1 style="padding: 50px;" id="ourResult"></h1> -->
        <?php
            $head[] = Html::tag('div','Polling Result',['class'=>'panel-heading', 'style'=>'font-size: 25px;']);
            $body[] = Html::tag('div','',['class'=>'panel-body', 'id'=>'ourResult']);
            echo Html::tag('div',implode($head).implode($body),['class'=>'panel panel-primary']);
        ?>


    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-index -->
