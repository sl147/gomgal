<?php include 'views/poster/menuPoster.php';?>
<h2 class='text-center'>ОГОЛОШЕННЯ</h2>
<table class='table table-hover table-responsive'> 
	<thead>
		<tr class='success' style='color: grey; font-size:12px; font-weight:bold;'>
			<th class="text-center">категорія</th>
			<th class="text-center showLarge">купівля</th>
			<th class="text-center showLarge">продаж</th>
			<th class="text-center showLarge">оренда</th>
			<th class="text-center showLarge">обмін</th>
			<th class="text-center showLarge">послуги</th>
			<th class="text-center">всього</th>
		</tr>
	</thead>
	<tbody>
	<?php $j=1; foreach ($posterCat as $item) :?>
		<?php if ($item['cat_cat'] <> 'all') :?>
			<tr class='text-center' style='color: grey; font-size:14px; font-weight:bold;'>
				<td class='text-left'>
					<a href='/posterCatFull/<?=$item["id"]?>'><?=$item["cat_cat"]?></a>
				</td>
				<?php include 'views/poster/showRowPoster.php';?>
			</tr>
		<?php else: ?>
			<tr class='info text-center' style='color: grey; font-size:16px; font-weight:bold;'>
				<td class='text-left' style='color: red; font-size:20px; font-weight:bold;'>Всього</td>
				<?php include 'views/poster/showRowPoster.php';?>
			</tr>
		<?php endif; ?>
		<?php $j++; if( ($j == 10) || ($j == 25) ) :?>
			<tr >
				<td colspan="7"><?=Auxiliary::getAdSence()?></td>
			</tr>
		<?php endif;?>
	<?php endforeach; ?>
	</tbody>
</table>