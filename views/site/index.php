<?php

use yii\helpers\Html;
use yii\helpers\Url; 

use app\models\Kegiatan;
use app\models\Risiko;
use app\models\KegiatanStakeholder;

$this->title = "Halaman Dashboard";

?>


<div class="row">
	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<p>Kegiatan</p>

				<h3>3 <sup class="small-box-sup">Kegiatan</sup></h3>
			</div>
			<div class="icon">
				<i class="fa fa-check-square-o"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<p>Risiko</p>

				<h3>3 <sup class="small-box-sup">Risiko</sup></h3>
			</div>
			<div class="icon">
				<i class="fa fa-warning"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple">
			<div class="inner">
				<p>Stakeholder</p>
				
				<h3>3 <sup class="small-box-sup">Stakeholder</sup></h3>
			</div>
			<div class="icon">
				<i class="fa fa-user-o"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>

<?= Yii::$app->user->identity->role; ?>