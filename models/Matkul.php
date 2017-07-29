<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matkul".
 *
 * @property integer $id
 * @property string $kode
 * @property integer $id_jurusan
 * @property integer $semester
 * @property integer $id_semester
 * @property string $nama
 * @property integer $sks
 *
 * @property PerwalianMatkul[] $perwalianMatkuls
 */
class Matkul extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matkul';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jurusan', 'semester', 'id_semester', 'sks'], 'integer'],
            [['id_semester'], 'required'],
            [['kode', 'nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'id_jurusan' => 'Id Jurusan',
            'semester' => 'Semester',
            'id_semester' => 'Id Semester',
            'nama' => 'Nama',
            'sks' => 'Sks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerwalianMatkuls()
    {
        return $this->hasMany(PerwalianMatkul::className(), ['id_matkul' => 'id']);
    }

    public function findAllMatkul()
    {
        $id_jurusan = User::getJurusan();
        return Matkul::find()->where(['id_jurusan' => $id_jurusan])->all();
    }
}
