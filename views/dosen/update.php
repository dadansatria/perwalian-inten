<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dosen */

$this->title = "Sunting Dosen";
$this->params['breadcrumbs'][] = ['label' => 'Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="dosen-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
