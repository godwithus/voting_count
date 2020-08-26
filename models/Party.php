<?php
/* JESUS Phil 2:9-11 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property integer $id
 * @property string $partyid
 * @property string $partyname
 */
class Party extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partyid', 'partyname'], 'required'],
            [['partyid', 'partyname'], 'string', 'max' => 11],
        ];
    }

    // We want the State option have just one value
    public static function partyAll(){        
        $array = Party::find()->all();
        return $array;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partyid' => 'Party Name',
            'partyname' => 'Partyname',
        ];
    }
}
