<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dosen */

$this->title = "Tambah Dosen";
$this->params['breadcrumbs'][] = ['label' => 'Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
