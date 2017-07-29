<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PerwalianMatkul */

$this->title = "Tambah Perwalian Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Perwalian Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perwalian-matkul-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
