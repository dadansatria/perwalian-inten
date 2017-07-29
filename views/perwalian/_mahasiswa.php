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
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach ($model->getMatkulMahasiswa() as $data): ?>
    
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data->matkul->nama; ?></td>
                <td>
                    <?php if(!$data->isDiambilBoolean()){ ?>
                        <?= Html::a('<i class="fa fa-check"></i> Ambil', ['perwalian-matkul/direct-create','id_perwalian'=>$model->id,'id_matkul' => $data->id_makul],[
                            'class' => 'btn btn-success btn-flat',
                            'data' => [
                                'confirm' => "Apa anda yakin untuk menolak pengambilan mata kuliah ini oleh mahasiswa?",
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?= Html::a('<i class="fa fa-remove"></i> Tidak Ambil', ['matkul-mahasiswa/tidak-ambil','id'=>$data->id],[
                                'class' => 'btn btn-danger btn-flat',
                                'data' => [
                                    'confirm' => "Apa anda yakin untuk tidak mengambil matkul ini?",
                                    'method' => 'post',
                                ],
                            ]) ?>
                    <?php } else { ?>
                        <i class="fa fa-check"></i>
                    <?php } ?>
                </td>
            </tr>
            <?php $i++; endforeach ?>
        </table>
    </div>
</div>
