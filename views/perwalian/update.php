<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Perwalian */

$this->title = "Sunting Perwalian";
$this->params['breadcrumbs'][] = ['label' => 'Perwalians', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="perwalian-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
