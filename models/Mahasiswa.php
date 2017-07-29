<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Matkul;
use app\models\MatkulMahasiswa;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property string $npm
 * @property string $nama
 * @property string $alamat
 * @property string $hp
 * @property integer $id_jurusan
 * @property string $angkatan
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npm'], 'required'],
            [['id_jurusan'], 'integer'],
            [['npm'], 'string', 'max' => 50],
            [['nama', 'alamat', 'hp', 'angkatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'npm' => 'Npm',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'hp' => 'Hp',
            'id_jurusan' => 'Id Jurusan',
            'angkatan' => 'Angkatan',
        ];
    }

    public function generateMatkulMahasiswa()
    {
        $id_jurusan = User::getJurusan();

        $find = MatkulMahasiswa::find()->where(['id_mahasiswa' => Yii::$app->user->identity->npm])->one();
        if($find == null){
            foreach (Matkul::find()->all() as $data) {
                $model = new MatkulMahasiswa();
                $model->id_mahasiswa = Yii::$app->user->identity->npm;
                $model->id_makul = $data->id;
                $model->semester = $data->semester;
                $model->id_semester = $data->id_semester;
                $model->id_status = 2;
                $model->save();
            }    
        }
    }

    public function findAllMatkul($i)
    {
        return MatkulMahasiswa::find()
            ->joinWith('matkul')
            ->where(['id_mahasiswa' => $this->npm])
            ->andWhere(['matkul_mahasiswa.semester' => $i])
            ->andWhere(['matkul.id_jurusan' => $this->id_jurusan])
            ->all();
    }

    public static function getDosenWali()
    {
        $id_jurusan = User::getJurusan();
        $model = Jurusan::findOne($id_jurusan);
        return $model->id_dosen;
    }

}
