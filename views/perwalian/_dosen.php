<?php

use yii\helpers\Html;

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pengambilan Mata Kuliah</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Nilai</th>
                <th>Konversi</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach ($model->perwalianMatkuls as $data): ?>
    
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data->matkul->nama; ?></td>
                <td><?= $data->nilai; ?></td>
                <td><?= $data->getNilaiKonversi(); ?></td>
                <?php if($model->status == 2){ ?>
                    <td><?= Html::a('<i class="fa fa-remove"></i>', ['perwalian-matkul/delete','id'=>$data->id],[
                        'data' => [
                            'confirm' => "Apa anda yakin untuk menolak pengambilan mata kuliah ini oleh mahasiswa?",
                            'method' => 'post',
                        ],
                    ]) ?>
                    </td>
                <?php } ?>
            </tr>
            <?php $i++; endforeach ?>
        </table>
    </div>
</div>
