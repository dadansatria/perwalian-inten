<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Perwalian */

$this->title = "Detail Perwalian";
$this->params['breadcrumbs'][] = ['label' => 'Perwalian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perwalian-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail Perwalian</h3>
    </div>

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            [
                'attribute' => 'nama',
                'format' => 'raw',
                'value' => $model->nama,
            ],
            [
                'attribute' => 'id_dosen',
                'format' => 'raw',
                'value' => $model->dosen->nama,
            ],
            [
                'attribute' => 'npm',
                'label' => 'Nama Mahasiswa',
                'format' => 'raw',
                'value' => $model->mahasiswa->nama,
            ],
            [
                'attribute' => 'npm',
                'format' => 'raw',
                'value' => $model->npm,
            ],
            [
                'attribute' => 'semester',
                'format' => 'raw',
                'value' => $model->semester,
            ],
            [
                'attribute' => 'keterangan',
                'format' => 'raw',
                'value' => $model->keterangan,
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
        <?php if($model->status == 2 AND User::isDosen()){ ?>
            <?= Html::a('<i class="fa fa-check"></i> Tandatangani Perwalian', ['tandatangani','id'=>$model->id],[
                        'class' => 'btn btn-info btn-flat',
                        'data' => [
                            'confirm' => "Apa anda yakin untuk menyetujui perwalian ini?",
                            'method' => 'post',
                        ],
                    ]) ?>
        <?php } elseif($model->status == 1) { ?>
            <div>&nbsp;</div>
            <div class="alert alert-success">Perwalian Telah Disetujui</div>
        <?php } ?>
    </div>
</div>

<?php if(User::isDosen()){
    print $this->render('_dosen',['model'=>$model]);
} elseif(User::isMahasiswa()){
    print $this->render('_mahasiswa',['model'=>$model]);
}