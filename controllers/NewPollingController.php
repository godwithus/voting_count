<?php
/* JESUS Phil 2:9-11 */
namespace app\controllers;
use app\models\PollingUnit;
use app\models\States; 
use app\models\Party;
use app\models\Ward;
use app\models\AnnouncedPuResults;
use Yii;

class NewPollingController extends \yii\web\Controller
{
    public function actionIndex()
    {    	
    	$model = new PollingUnit();
    	$state = new States();
    
    	if ($model->load(Yii::$app->request->post()) && $state->load(Yii::$app->request->post())) {
    		$model->entered_by_user = 'Some Body';
    		$model->user_ip_address = $_SERVER['REMOTE_ADDR'];
    		$model->polling_unit_id = rand(0, 100);
    		$model->date_entered = date('Y-m-d h:i:s');
            $model->ward_id = $model->uniquewardid;

    		if ($model->save()) {

                \Yii::$app->session->setFlash('success', 'New Polling Unit Created Successful');
    			return $this->redirect('new-result');
    		}
    	}

        return $this->render('index', ['model'=>$model, 'state'=>$state]);
    }

    public function actionNewResult(){ 
    	$model = new PollingUnit();
    	$state = new States();
    	$party = new Party();
    	$score = new AnnouncedPuResults();

    	if ($model->load(Yii::$app->request->post()) && $state->load(Yii::$app->request->post()) && $party->load(Yii::$app->request->post()) && $score->load(Yii::$app->request->post())) {
            
            if(strlen($party->partyid) > 4){
                $score->party_abbreviation = substr($party->partyid, 0, 4);
            }else{
                $score->party_abbreviation = $party->partyid;
            }

    		$score->polling_unit_uniqueid =  $model->polling_unit_id;
    		$score->entered_by_user 	  =  'Some Body';
    		$score->date_entered 		  =  date('Y-m-d h:i:s');
    		$score->user_ip_address 	  =  $_SERVER['REMOTE_ADDR'];
    		$score->save();
            

            \Yii::$app->session->setFlash('success_new', 'Result Submitted Successful Created Successful');
    	}
        return $this->render('new-result', ['model'=>$model, 'state'=>$state]);

    
    }

}
