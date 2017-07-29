<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jurusan */

$this->title = "Sunting Jurusan";
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="jurusan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
