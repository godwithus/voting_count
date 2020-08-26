<?php
/* JESUS Phil 2:9-11 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "polling_unit".
 *
 * @property integer $uniqueid
 * @property integer $polling_unit_id
 * @property integer $ward_id
 * @property integer $lga_id
 * @property integer $uniquewardid
 * @property string $polling_unit_number
 * @property string $polling_unit_name
 * @property string $polling_unit_description
 * @property string $lat
 * @property string $long
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class PollingUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polling_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['polling_unit_id', 'ward_id', 'lga_id','polling_unit_name','polling_unit_description'], 'required'],
            [['polling_unit_id', 'ward_id', 'lga_id', 'uniquewardid'], 'integer'],
            [['polling_unit_description'], 'string'],
            [['date_entered'], 'safe'],
            [['polling_unit_number', 'polling_unit_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['lat', 'long'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Polling Unit',
            'polling_unit_id' => 'Polling Unit',
            'ward_id' => 'Ward Name',
            'lga_id' => 'Lga Name',
            'uniquewardid' => 'Ward Name',
            'polling_unit_number' => 'Polling Unit Number',
            'polling_unit_name' => 'Polling Unit Name',
            'polling_unit_description' => 'Polling Unit Description',
            'lat' => 'Lat',
            'long' => 'Long',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }


    // We want the courses option to be empty when the page loads
    
    public static function pollingAll(){        
        $array = array('1' => ' --- No Polling Unit to display --- ', );
        return $array;
    }

    // We want the Polling Unit option to be filled when adding result for new created Unit
    public static function pollingAllOne($val){  

        $onePollingUnit = PollingUnit::findOne(['polling_unit_id'=>$val]);
        return array($onePollingUnit->polling_unit_id => $onePollingUnit->polling_unit_name );
    }

    public function getLga(){
        return $this->hasMany(Lga::className(), ['lga_id'=>'lga_id']);
    }
    
    public function getStates()
    {
         return $this->hasMany(States::className(), ['state_id' => 'state_id'])
            ->via('lga');
    }

    public function getWard(){
        return $this->hasOne(Ward::className(), ['ward_id'=>'ward_id']);
    }
}
