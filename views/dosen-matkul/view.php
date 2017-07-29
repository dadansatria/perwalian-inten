<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DosenMatkul */

$this->title = "Detail Dosen Matkul";
$this->params['breadcrumbs'][] = ['label' => 'Dosen Matkul', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-matkul-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail Dosen Matkul</h3>
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
                'attribute' => 'id_matkul',
                'format' => 'raw',
                'value' => $model->id_matkul,
            ],
            [
                'attribute' => 'id_dosen',
                'format' => 'raw',
                'value' => $model->id_dosen,
            ],
        ],
    ]) ?>

    </div>

    <div class="box-footer">
        <?= Html::a('<i class="fa fa-pencil"></i> Sunting Dosen Matkul', ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a('<i class="fa fa-list"></i> Daftar Dosen Matkul', ['index'], ['class' => 'btn btn-warning btn-flat']) ?>
    </div>

</div>
