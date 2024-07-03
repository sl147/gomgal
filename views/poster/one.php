<?php include 'views/poster/menuPoster.php';?>
<div class="row">
	<div class='col-lg-2 col-md-2 col-sm-0 col-xs-0'></div>
	<div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>
		<h2 class="text-center"><?= $title?></h2>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class='posterTXT col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center'>
			№ оголошення: <?= $posterOne["id_poster"]?>
		</div>
		<div class="showLarge">
			<div class='posterTXT col-lg-4 col-md-4 col-sm-2 col-xs-2'>
				<?$p = new Poster();?>
				<?= $p->getTypePost($posterOne["type_p"])?>
			</div>
			<div class='posterTXT col-lg-4 col-md-4 col-sm-4 col-xs-4'>
				<?=$posterOne["date_p"]?>
			</div>
		</div>
	</div><br>
<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<?=Auxiliary::getAdSence()?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<?=$p->showPhoto($posterOne);unset($p)?>
		</div>		
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div class="posterMSG">
				<?=$posterOne["msg_p"]?><br><br>
			Надіслав(ла): <?=$posterOne['name_p']?><br>
			e-mail: <?=$poster_email?>
			</div>
		</div>
		<div class="close1"></div>
	</div>
	
</div>