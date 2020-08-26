<?php
/* JESUS Phil 2:9-11 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $state_id
 * @property string $state_name
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id', 'state_name'], 'required'],
            [['state_id'], 'integer'],
            [['state_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'state_id' => 'State Name',
            'state_name' => 'State Name',
        ];
    }

    // We want the State option have just one value
    public static function stateAll(){        
        $array = array(25 => 'Delta', );
        return $array;
    }

    public function getLga(){
        return $this->hasMany(Lga::className(), ['state_id'=>'lga_id']);
    }
}
