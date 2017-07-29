<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MatkulMahasiswa */

$this->title = "Detail Matkul Mahasiswa";
$this->params['breadcrumbs'][] = ['label' => 'Matkul Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matkul-mahasiswa-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail Matkul Mahasiswa</h3>
    </div>

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => $model->id,
            ],
            [
                'attribute' => 'id_mahasiswa',
                'format' => 'raw',
                'value' => $model->id_mahasiswa,
            ],
            [
                'attribute' => 'id_makul',
                'format' => 'raw',
                'value' => $model->id_makul,
            ],
            [
                'attribute' => 'id_semester',
                'format' => 'raw',
                'value' => $model->id_semester,
            ],
            [
                'attribute' => 'id_status',
                'format' => 'raw',
                'value' => $model->id_status,
            ],
        ],
    ]) ?>

    </div>

    <div class="box-footer">
        <?= Html::a('<i class="fa fa-pencil"></i> Sunting Matkul Mahasiswa', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a('<i class="fa fa-list"></i> Daftar Matkul Mahasiswa', ['index'], ['class' => 'btn btn-warning btn-flat']) ?>
    </div>

</div>
