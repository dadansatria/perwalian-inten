<?php
	use app\models\MatkulMahasiswa;
	use app\models\Perwalian;
	use yii\helpers\Html;
?>

<?php for ($i=1; $i <=12 ; $i++) {  ?>

	<div class="box box-primary">
		<div class="box-header with-border">
		    <?php if(!Perwalian::isPerwalian($i)) { ?>
		    <h3 class="box-title">Semester <?= $i; ?></h3>
		    <div>&nbsp;</div>
	            <?= Html::a('<i class="fa fa-check"></i> Mulai Perwalian', ['perwalian/create','npm'=>$model->npm,'semester'=>$i],[
	                        'class' => 'btn btn-success btn-flat',
	                        'data' => [
	                            'confirm' => "Apa anda yakin untuk menyetujui perwalian ini?",
	                            'method' => 'post',
	                        ],
				]) ?>
			<?php } else { ?>
				<h3 class="box-title"><?= Html::a("Semester ".$i, ['perwalian/view-semester','semester'=>$i]); ?></h3>
			<?php } ?>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th width="60%" class="text-center" rowspan="2" colspan="3"><h3 class="box-title">Semester <?= $i; ?></h3></th>
					<th class="text-center" rowspan="2">SKS</th>
					<th class="text-center" colspan="4">Status</th>
				</tr>
				<tr>
					<th class="text-center">Diambil</th>
					<th class="text-center">Nilai</th>
					<th class="text-center">Konversi Nilai</th>
				</tr>
				<?php $sks=null; $nilai=null; $ip=null; $no=1; foreach ($model->findAllMatkul($i) as $data): ?>			
					<tr>
						<td><?= $no; ?></td>
						<td><?= $data->matkul->kode; ?></td>
						<td><?= $data->matkul->nama; ?></td>
						<td class="text-center"><?= $data->matkul->sks; ?></td>
						<td class="text-center"><?= $data->isDiambil(); ?></td>
						<td class="text-center"><?= $data->getNilaiPerwalianMatkul(); ?></td>
						<td class="text-center"><?= $data->getNilaiKonversi(); ?></td>
					</tr>
					<?php 	
						$sks = $sks + $data->matkul->sks;
						$nilai = $nilai + $data->getNilaiBobot(); 
						if($sks == 0){
							$ip = 0;
						} else{
							$ip = $nilai / $sks;
						}
					?>
				<?php $no++; endforeach ?>
				<tr>
					<th class="text-center" colspan="3">Kalkulasi</th>
					<th class="text-center"><?= $sks; ?></th>
					<th class="text-center" colspan="3"><?= $ip; ?></th>
				</tr>
			</table>
		</div>
	</div>
<?php } ?>