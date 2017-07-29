<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PerwalianMatkul */

$this->title = "Detail Perwalian Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Perwalian Matkul', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perwalian-matkul-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail Perwalian Matkul</h3>
    </div>

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            [
                'attribute' => 'id_matkul',
                'format' => 'raw',
                'value' => $model->matkul->nama,
            ],
            [
                'attribute' => 'id_perwalian',
                'format' => 'raw',
                'value' => $model->perwalian->nama,
            ],
            [
                'label' => 'Mahasiswa',
                'format' => 'raw',
                'value' => $model->perwalian->mahasiswa->nama,
            ],
            [
                'label' => 'NPM',
                'format' => 'raw',
                'value' => $model->perwalian->npm,
            ],
            [
                'attribute' => 'nilai',
                'format' => 'raw',
                'value' => $model->nilai,
            ],
            [
                'label' => 'konversi',
                'format' => 'raw',
                'value' => $model->getNilaiKonversi(),
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->getStatus(),
            ],
        ],
    ]) ?>

    </div>

    <div class="box-footer">

    <?php if($model->status == 2){ ?>
        <?= Html::a('<i class="fa fa-pencil"></i> Beri Nilai', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>
    <?php } ?>
    </div>
</div>

