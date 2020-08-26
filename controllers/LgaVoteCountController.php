<?php
/* JESUS Phil 2:9-11 */
namespace app\controllers;

use app\models\PollingUnit;
use app\models\States;
use app\models\Lga;
use app\models\Ward;
use app\models\AnnouncedPuResults;

class LgaVoteCountController extends \yii\web\Controller
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
                $select .= "<option value='".$lga->lga_id."'>".$lga->lga_name."</option>";
            }
            echo $select;

        }else{
                echo "<option> ... </option>";
        }
    }

 public function actionGetWard($id)
    {

    	// We get the Lga name
        $avaliableLga = Lga::findOne(['lga_id'=>$id]);
        $lgaName = $avaliableLga->lga_name; // We use this to track down the lga_name

        //////////////////////////////////////
        //////////////////////////////////////

        $PDP = $DPP = $ACN = $PPA = $CDC = $JP = $ANPP = $LABOUR = $CPP = 0;

        //////////////////////////////////////
        //////////////////////////////////////

        // We get the Ward Count
        $countWard = Ward::find()
            ->where(['lga_id'=>$id])
            ->count();
	
		// We get the Ward Content
        $avaliableWard = Ward::find()
            ->where(['lga_id'=>$id])
            ->all();

        // Looping through the Ward data
        foreach ($avaliableWard as $key) {

    		$wardUniqueId = $key->ward_id;

	        // We get the PollingUnit Count
	        $countPollingUnit = PollingUnit::find()
	            ->where(['ward_id'=>$wardUniqueId])
	            ->count();

	        // We get the PollingUnit Content
	        $avaliablePollingUnit = PollingUnit::find()
	            ->where(['ward_id'=>$wardUniqueId])
	            ->all();

        		// Looping through the PollingUnit data
	            foreach ($avaliablePollingUnit as $key) {

		    		$pollUniqueId = $key->ward_id;

			        // We get the AnnouncedPuResults Count
			        $countPollingUnit = AnnouncedPuResults::find()
			            ->where(['polling_unit_uniqueid'=>$wardUniqueId])
			            ->count();

			        // We get the AnnouncedPuResults Content
			        $avaliablePollingUnit = AnnouncedPuResults::find()
			            ->where(['polling_unit_uniqueid'=>$wardUniqueId])
			            ->all();

			            foreach ($avaliablePollingUnit as $key) {
                            $loadPartyName = $key->party_abbreviation;

                            // We are collating the score for each party using the party name
                            //if ($partyName  == $partyName[$key->party_abbreviation]) {
// 'a'=>'PDP','b'=>'DPP','c'=>'ACN','d'=>'PPA','e'=>'CDC','f'=>'JP','g'=>'ANPP','LABOUR'=>'LABOUR','CPP'=>'CPP'

                            if($loadPartyName == 'PDP'){
                                $PDP = $PDP + $key->party_score;

                            }elseif($loadPartyName == 'DPP'){
                                $DPP = $DPP + $key->party_score;

                            }elseif($loadPartyName == 'ACN'){
                                $ACN = $ACN + $key->party_score;

                            }elseif($loadPartyName == 'PPA'){
                                $PPA = $PPA + $key->party_score;

                            }elseif($loadPartyName == 'CDC'){
                                $CDC = $CDC + $key->party_score;

                            }elseif($loadPartyName == 'JP'){
                                $JP = $JP + $key->party_score;

                            }elseif($loadPartyName == 'ANPP'){
                                $ANPP = $ANPP + $key->party_score;

                            }elseif($loadPartyName == 'LABO'){
                                $LABOUR = $LABOUR + $key->party_score;

                            }elseif($loadPartyName == 'CPP'){
                                $CPP = $CPP + $key->party_score;
                            }
			            }
	            }
        }

            // Displaying the result of our Vote in the local goverment
         ?>
            <option style="font-size: 30px;"> <?= $lgaName ?> LGA </option>
            <option style="font-size: 20px;"> PDP &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  <?= $PDP ;?> </option> <hr/>
            <option style="font-size: 20px;"> DPP &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  <?= $DPP ;?> </option> <hr/>
            <option style="font-size: 20px;"> ACN &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  <?= $ACN ;?> </option> <hr/>
            <option style="font-size: 20px;"> PPA &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  <?= $PPA ;?> </option> <hr/>
            <option style="font-size: 20px;"> CDC &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  <?= $CDC ;?> </option> <hr/>
            <option style="font-size: 20px;"> JP &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  <?= $JP ;?> </option> <hr/>
            <option style="font-size: 20px;"> ANPP &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;    &nbsp;  <?= $ANPP ;?> </option> <hr/>
            <option style="font-size: 20px;"> LABOUR &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;   &nbsp;  <?= $LABOUR ;?> </option> <hr/>
            <option style="font-size: 20px;"> CPP &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;   &nbsp;  &nbsp;  &nbsp;   &nbsp;  &nbsp;  <?= $CPP ;?> </option>
        <?php
    }

}
