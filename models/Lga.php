<?php
/* JESUS Phil 2:9-11 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "lga".
 *
 * @property integer $uniqueid
 * @property integer $lga_id
 * @property string $lga_name
 * @property integer $state_id
 * @property string $lga_description
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class Lga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lga';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lga_id', 'lga_name', 'state_id', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['lga_id', 'state_id'], 'integer'],
            [['lga_description'], 'string'],
            [['date_entered'], 'safe'],
            [['lga_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Uniqueid',
            'lga_id' => 'Lga ID',
            'lga_name' => 'Lga Name',
            'state_id' => 'State ID',
            'lga_description' => 'Lga Description',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }

    // We want the LGA option to be empty when the page loads
    public static function lgaAll(){        
        $array = array('1' => ' --- No LGA to display --- ', );
        return $array;
    }

    // We want the LGA option to be filled when adding result for new created Unit
    public static function lgaAllOne($val){  

        $oneLga = Lga::findOne(['lga_id'=>$val]);
        return array($oneLga->lga_id => $oneLga->lga_name );
    }

    public function getStates(){
         return $this->hasOne(States::className(), ['state_id'=>'state_id']);
    }


    public function getWard(){
         return $this->hasMany(Ward::className(), ['lga_id'=>'lga_id']);
    }

    public function getPollingUnit(){
        return $this->hasMany(PollingUnit::className(), ['lga_id'=>'lga_id']);
    }
}
