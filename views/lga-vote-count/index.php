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
<div class="polling-unit-result-index">

<center class="well well-sm" style="background-color: #f1f1f1">
    <h1>LGA Vote Count</h1>
</center>


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($state, 'state_id')->dropDownList(
        ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),
            [
                'prompt'=>'Select State',
                'onchange'=>'

                    $.post("'.Yii::$app->urlManager->createUrl('/lga-vote-count/get-lga?id=').'"+$(this).val(),

                    function(data){
                        $("select[id=pollingunit-lga_id]").html("<option value=\"\">--Select LGA Name--</option>"+data);
                    });',
            ]);
        ?>

        <?= $form->field($model, 'lga_id')->dropDownList(Lga::lgaAll(),
            [
                'multiple' => false,
                'onchange'=>'

                    $.post("'.Yii::$app->urlManager->createUrl('/lga-vote-count/get-ward?id=').'"+$(this).val(),

                    function(data){
                        $("div[id=pollingunit-ward_id]").html(data);
                    });',
        ]);?>

        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
            $head[] = Html::tag('div','LGA Polling Result Holder',['class'=>'panel-heading', 'style'=>'font-size: 25px;']);
            $body[] = Html::tag('div','',['class'=>'panel-body', 'id'=>'pollingunit-ward_id']);
            echo Html::tag('div',implode($head).implode($body),['class'=>'panel panel-primary']);
        ?>
        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
        
    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-result-index -->
