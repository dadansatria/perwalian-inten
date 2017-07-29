<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Matkul */

$this->title = "Tambah Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matkul-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
