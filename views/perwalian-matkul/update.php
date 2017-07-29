<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PerwalianMatkul */

$this->title = "Sunting Perwalian Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Perwalian Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="perwalian-matkul-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
