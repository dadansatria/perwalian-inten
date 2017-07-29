<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matkul_mahasiswa".
 *
 * @property integer $id
 * @property integer $id_mahasiswa
 * @property integer $id_makul
 * @property integer $id_semester
 * @property integer $id_status
 */
class MatkulMahasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matkul_mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_makul', 'id_semester', 'semester', 'id_status'], 'required'],

            [['id_mahasiswa'],'safe'],
            [['id_makul', 'id_semester', 'id_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mahasiswa' => 'Id Mahasiswa',
            'id_makul' => 'Id Makul',
            'id_semester' => 'Id Semester',
            'id_status' => 'Id Status',
        ];
    }

    public function getMatkul()
    {
        return $this->hasOne(Matkul::className(), ['id' => 'id_makul']);
    }

    public function getModelPerwalianMatkul()
    {
        $model = PerwalianMatkul::find()
            ->joinWith('perwalian')
            ->where(['id_matkul' => $this->id_makul])
            ->andWhere(['perwalian.npm' => Yii::$app->user->identity->npm])
            ->one();

        return $model;
    }

    public function getNilaiPerwalianMatkul()
    {
        $model = $this->getModelPerwalianMatkul();
        if($model !==null){
            return $model->nilai;
        } else{
            return null;
        }
    }

    public function getNilaiKonversi()
    {
        $model = $this->getModelPerwalianMatkul();
        if($model !==null){
            return $model->getNilaiKonversi();
        } else{
            return null;
        }
    }

    public function getNilaiBobot()
    {
        $model = $this->getModelPerwalianMatkul();
        if($model !==null){
            return $model->getNilaiBobot();
        } else{
            return null;
        }
    }

    public function isDiambil()
    {
        if($this->getModelPerwalianMatkul() !==null){
            return "<i class='fa fa-check'></i>";
        } else{
            return null;
        }
    }

    public function isDiambilBoolean()
    {
        if($this->getModelPerwalianMatkul() !==null){
            return true;
        } else{
            return false;
        }
    }


}
