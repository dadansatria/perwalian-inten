<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen_matkul".
 *
 * @property integer $id
 * @property integer $id_matkul
 * @property integer $id_dosen
 */
class DosenMatkul extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dosen_matkul';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_matkul', 'id_dosen'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_matkul' => 'Id Matkul',
            'id_dosen' => 'Id Dosen',
        ];
    }
}
