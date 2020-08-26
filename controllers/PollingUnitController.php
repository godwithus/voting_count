<?php
/* JESUS Phil 2:9-11 */

namespace app\controllers;
use app\models\PollingUnit;
use app\models\States;
use app\models\Lga;
use app\models\Ward;
use app\models\AnnouncedPuResults;

class PollingUnitController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$model = new PollingUnit();
    	$state = new States();

    	// if ($model->load(Yii::$app->$request->post())) {
    	// 	# code...
    	// }
        return $this->render('index', ['model'=>$model, 'state'=>$state]);
    }

    public function actionGetLga($id)
    {
        //echo "<option> - </option>";
        $select = '';
        $countLga = Lga::find()
            ->where(['state_id'=>$id])
            ->count();

        $avaliableLga = Lga::find()
            ->where(['state_id'=>$id])
            ->all();

        if ($countLga > 0) {

            foreach ($avaliableLga as $lga) {
                $select .= "<option value='".$lga->uniqueid."'>".$lga->lga_name."</option>";
            }
            echo $select;

        }else{
                echo "<option> ... </option>";
        }
    }

 public function actionGetWard($id)
    {
        //echo "<option> - </option>";
        $select = '';
        $countWard = Ward::find()
            ->where(['lga_id'=>$id])
            ->count();

        $avaliableWard = Ward::find()
            ->where(['lga_id'=>$id])
            ->all();

        if ($countWard > 0) {

            foreach ($avaliableWard as $ward) {
                $select .= "<option value='".$ward->ward_id."'>".$ward->ward_name."</option>";
            }
            echo $select;

        }else{
                echo "<option> ... </option>";
        }


    }

 public function actionGetPollingUnit($id)
    {
        //echo "<option> - </option>";
        $select = '';
        $countPollingUnit = PollingUnit::find()
            ->where(['ward_id'=>$id])
            ->count();

        $avaliablePollingUnit = PollingUnit::find()
            ->where(['ward_id'=>$id])
            ->all();

        if ($countPollingUnit > 0) {

            foreach ($avaliablePollingUnit as $ward) {
                $select .= "<option value='".$ward->polling_unit_id."'>".$ward->polling_unit_name."</option>";
            }
            echo $select;

        }else{
                echo "<option> ... </option>";
        }


    }

 public function actionGetPollingUnitName($id)
    {
        //echo "<option> - </option>";
        $select = '';
        $countPollingUnitName = AnnouncedPuResults::find()
            ->where(['polling_unit_uniqueid'=>$id])
            ->count();

        $avaliablePollingUnitName = AnnouncedPuResults::find()
            ->where(['polling_unit_uniqueid'=>$id])
            ->all();

        if ($countPollingUnitName > 0) {
        	
            foreach ($avaliablePollingUnitName as $ward) {
                //////////////////////////////////////////////
                //////////////////////////////////////////////
                if ($ward->party_abbreviation === 'LABO') {
                    $ward->party_abbreviation = 'LABOUR';
                }
        ?>
			<option style="font-size: 20px; ">
                <?php echo $ward->party_abbreviation; ?> &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                <?php echo $ward->party_score; ?>
            </option>
        			
        <?php
                //////////////////////////////////////////////
                //////////////////////////////////////////////
            }

        }else{
                echo "<span style='font-size: 20px'> No Result </span>";
        }


    }

}
