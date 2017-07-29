<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perwalian_matkul".
 *
 * @property integer $id
 * @property integer $id_matkul
 * @property integer $id_perwalian
 * @property string $nilai
 * @property integer $status
 *
 * @property Perwalian $idPerwalian
 * @property Matkul $idMatkul
 */
class PerwalianMatkul extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perwalian_matkul';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_matkul', 'id_perwalian', 'status'], 'integer'],
            [['nilai'], 'string', 'max' => 255],
            [['id_perwalian'], 'exist', 'skipOnError' => true, 'targetClass' => Perwalian::className(), 'targetAttribute' => ['id_perwalian' => 'id']],
            [['id_matkul'], 'exist', 'skipOnError' => true, 'targetClass' => Matkul::className(), 'targetAttribute' => ['id_matkul' => 'id']],
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
            'id_perwalian' => 'Id Perwalian',
            'nilai' => 'Nilai',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerwalian()
    {
        return $this->hasOne(Perwalian::className(), ['id' => 'id_perwalian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatkul()
    {
        return $this->hasOne(Matkul::className(), ['id' => 'id_matkul']);
    }

    public function getNilaiKonversi()
    {
        if($this->nilai >= 80){
            return "A";
        } elseif($this->nilai <79 AND $this->nilai >=65){
            return "B";
        } elseif($this->nilai <64 AND $this->nilai >=55){
            return "C";
        } elseif($this->nilai <54 AND $this->nilai >=45){
            return "D";
        } elseif($this->nilai <44){
            return "E";
        }
    }

    public function getNilaiBobot()
    {
        if($this->nilai >= 80){
            return 4;
        } elseif($this->nilai <79 AND $this->nilai >=65){
            return 3;
        } elseif($this->nilai <64 AND $this->nilai >=55){
            return 2;
        } elseif($this->nilai <54 AND $this->nilai >=45){
            return 1;
        } elseif($this->nilai <44){
            return 0;
        }
    }


    public function getStatus()
    {
        if($this->status == 1){
            return "Telah Dinilai";
        } else{
            return "Belum Dinilai";
        }
    }
}
