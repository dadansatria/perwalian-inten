<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DosenMatkul */

$this->title = "Tambah Dosen Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Dosen Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-matkul-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
