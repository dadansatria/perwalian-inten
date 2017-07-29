<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Perwalian */

$this->title = "Tambah Perwalian";
$this->params['breadcrumbs'][] = ['label' => 'Perwalians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perwalian-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
