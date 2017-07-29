<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perwalian".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $id_dosen
 * @property string $npm
 * @property integer $semester
 * @property string $keterangan
 * @property integer $status
 *
 * @property PerwalianMatkul[] $perwalianMatkuls
 */
class Perwalian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perwalian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dosen', 'semester', 'status'], 'integer'],
            [['nama', 'npm', 'keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'id_dosen' => 'Id Dosen',
            'npm' => 'Npm',
            'semester' => 'Semester',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerwalianMatkuls()
    {
        return $this->hasMany(PerwalianMatkul::className(), ['id_perwalian' => 'id']);
    }

    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['npm' => 'npm']);
    }

    public function getDosen()
    {
        return $this->hasOne(Dosen::className(), ['id' => 'id_dosen']);
    }

    public function getStatus()
    {
        if($this->status == 1){
            return "Telah Ditandatangani";
        } else{
            return "Belum Ditandatangani";
        }
    }

    public function getMatkulMahasiswa()
    {
        return MatkulMahasiswa::find()
            ->joinWith('matkul')
            ->where(['matkul_mahasiswa.semester' => 1])
            ->andWhere(['id_mahasiswa' => $this->npm])
            ->andWhere(['matkul.id_jurusan' => User::getJurusan()])
            ->all();
    }

    public static function isPerwalian($semester)
    {
        $model = Perwalian::find()
            ->where(['semester' => $semester])
            ->andWhere(['npm' => Yii::$app->user->identity->npm])
            ->one();
        if ($model !==null) {
            return true;
        } else{
            return false;
        }
    }
}
