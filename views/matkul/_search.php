<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatkulSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matkul-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'id_jurusan') ?>

    <?= $form->field($model, 'semester') ?>

    <?= $form->field($model, 'id_semester') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'sks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
