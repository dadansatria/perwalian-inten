<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatkulMahasiswa */

$this->title = "Sunting Matkul Mahasiswa";
$this->params['breadcrumbs'][] = ['label' => 'Matkul Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="matkul-mahasiswa-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
