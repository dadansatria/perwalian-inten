<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MatkulMahasiswa */

$this->title = "Tambah Matkul Mahasiswa";
$this->params['breadcrumbs'][] = ['label' => 'Matkul Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matkul-mahasiswa-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
