<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DosenMatkul */

$this->title = "Sunting Dosen Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Dosen Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="dosen-matkul-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
