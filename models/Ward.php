<?php
/* JESUS Phil 2:9-11 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property integer $uniqueid
 * @property integer $ward_id
 * @property string $ward_name
 * @property integer $lga_id
 * @property string $ward_description
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ward_id', 'ward_name', 'lga_id', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['ward_id', 'lga_id'], 'integer'],
            [['ward_description'], 'string'],
            [['date_entered'], 'safe'],
            [['ward_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Uniqueid',
            'ward_id' => 'Ward ID',
            'ward_name' => 'Ward Name',
            'lga_id' => 'Lga ID',
            'ward_description' => 'Ward Description',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }


    // We want the courses option to be empty when the page loads
    public static function wardAll(){        
        $array = array('1' => ' --- No Ward to display --- ', );
        return $array;
    }

    // We want the LGA option to be filled when adding result for new created Unit
    public static function wardAllOne($val){  

        $oneLga = Ward::findOne(['uniqueid'=>$val]);
        return array($oneLga->ward_id => $oneLga->ward_name );
    }



    public function getLga(){
        return $this->hasOne(Lga::className(), ['lga_id'=>'lga_id']);
    }
}
