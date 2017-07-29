<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Matkul */

$this->title = "Detail Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Matkul', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matkul-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail Matkul</h3>
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
                'attribute' => 'kode',
                'format' => 'raw',
                'value' => $model->kode,
            ],
            [
                'attribute' => 'id_jurusan',
                'format' => 'raw',
                'value' => $model->id_jurusan,
            ],
            [
                'attribute' => 'semester',
                'format' => 'raw',
                'value' => $model->semester,
            ],
            [
                'attribute' => 'id_semester',
                'format' => 'raw',
                'value' => $model->id_semester,
            ],
            [
                'attribute' => 'nama',
                'format' => 'raw',
                'value' => $model->nama,
            ],
            [
                'attribute' => 'sks',
                'format' => 'raw',
                'value' => $model->sks,
            ],
        ],
    ]) ?>

    </div>

    <div class="box-footer">
        <?= Html::a('<i class="fa fa-pencil"></i> Sunting Matkul', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a('<i class="fa fa-list"></i> Daftar Matkul', ['index'], ['class' => 'btn btn-warning btn-flat']) ?>
    </div>

</div>
