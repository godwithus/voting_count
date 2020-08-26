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
use app\models\Party;
use app\models\AnnouncedPuResults;


$party = new Party();
$score= new AnnouncedPuResults();
/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */
/* @var $form ActiveForm */
?>
<div class="polling-unit-index">

<center class="well well-sm" style="background-color: #f1f1f1">
    <h1>Add New Polling Result</h1>
</center>

<?php if(\Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success">
        <?php echo \Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if(\Yii::$app->session->hasFlash('success_new')):?>
    <div class="alert alert-success">
        <?php echo \Yii::$app->session->getFlash('success_new'); ?>
    </div>
<?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($state, 'state_id')->dropDownList(States::stateAll(),
            [
                'prompt'=>'Select State',
                'onchange'=>'

                    $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-lga?id=').'"+$(this).val(),

                    function(data){
                        $("select[id=pollingunit-lga_id]").html("<option value=\"\">--Select State--</option>"+data);
                    });',
            ]);
        ?>

        <?= $form->field($model, 'lga_id')->dropDownList(Lga::lgaAll(),
            [
                'multiple' => false,
                'onchange'=>'

                    $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-ward?id=').'"+$(this).val(),

                    function(data){
                        $("select[id=pollingunit-uniquewardid]").html("<option value=\"\">--Select Ward --</option>"+data);
                    });',
        ]);?>

        <?= $form->field($model, 'uniquewardid')->dropDownList(Ward::wardAll(),
            [
                'multiple' => false,
                'onchange'=>'

                    $.post("'.Yii::$app->urlManager->createUrl('/polling-unit/get-polling-unit?id=').'"+$(this).val(),

                    function(data){
                        $("select[id=pollingunit-polling_unit_id]").html("<option value=\"\">-- Select Polling Unit --</option>"+data);
                    });',
        ]);?>

        <?= $form->field($model, 'polling_unit_id')->dropDownList(PollingUnit::pollingAll(),
            [
                'multiple' => false,
        ]);?>


    <?= $form->field($party, 'partyid')->dropDownList(
        ArrayHelper::map(Party::find()->all(), 'partyid', 'partyname'),
            [
                'prompt'=>'Select Party',
        ]);
    ?>

    <?= $form->field($score, 'party_score')->textInput(['maxlength' => true]) ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        
    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-index -->
