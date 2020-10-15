<?php include 'views/poster/menuPoster.php';?>
<div class="container-fluid">
	<div class="row">
		<div class='posterTXT col-lg-4 col-md-4 col-sm-0 col-xs-0'>
			№ оголошення: <?= $posterOne["id_poster"]?>
		</div>
		<div class='posterTXT col-lg-4 col-md-4 col-sm-0 col-xs-0'>
			<?$p = new Poster();?>
			<?= $p->getTypePost($posterOne["type_p"])?>
		</div>
		<div class='posterTXT col-lg-4 col-md-4 col-sm-0 col-xs-0'>
			<?=$posterOne["date_p"]?>
		</div>
	</div><br>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 posterTXT">
			<?=$p->showPhoto($posterOne);unset($p)?>
		</div>		
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 posterTXT">
			<?=$posterOne["msg_p"]?><br><br>
			Надіслав(ла): <?=$posterOne['name_p']?><br>
			e-mail: <?=$posterOne['email_p']?>		
		</div>
	</div>
</div>