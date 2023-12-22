<?php include 'views/poster/menuPoster.php';?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<table class='table table-hover table-responsive'> 
	<thead>
		<tr class='success' style='color: grey; font-size:12px; font-weight:bold;'>
			<th class='text-center showLarge'></th>
			<th class='text-center showLarge'>фото</th>
			<th class='text-center showLarge'>Оголошення</th>
			<th class='text-center showLarge'>Тип</th>
			<th class='text-center showLarge'>дата</th>
			<th class='text-center showLarge'>переглядів</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$p = new Poster();
			if ($page == 1) {
				$r = $p->showPosterAll($posterImpotant);
			}
			$r = $p->showPosterAll($posterAll);
			unset($p);
		?>
	</tbody>
</table>
</div>
<?php if ($total > SHOWPOSTER_BY_DEFAULT) :?>
	<div class="text-center"><? echo $pagination->get(); ?></div>
<?endif ;?>