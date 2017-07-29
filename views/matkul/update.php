<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Matkul */

$this->title = "Sunting Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Matkuls', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="matkul-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
