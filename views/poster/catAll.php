<?=Auxiliary::showReklRand()?>
<?php include 'views/poster/menuPoster.php';?>

<table class='table table-hover table-responsive'> 
	<thead>
		<tr class='success' style='color: grey; font-size:12px; font-weight:bold;'>
			<th></th>
			<th class='text-center'>Оголошення</th>
			<th class='text-center'>Тип</th>
			<th class='text-center'>дата</th>
			<th class='text-center'>переглядів</th>
		</tr>
	</thead>
	<tbody>
		<?php
			 if ($page == 1) {
				$r = Poster::showPosterAll($posterImpotant);
			}
			$r = Poster::showPosterAll($posterAll);
		?>
	</tbody>
</table>

<?php if ($total > SHOWPOSTER_BY_DEFAULT) :?>
	<div class="text-center"><? echo $pagination->get(); ?></div>
<?endif ;?>