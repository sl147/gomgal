<tr class='text-center'>
	<?$pp = new Poster();?>
	<div class="showLarge">
		<td>
			<?= $pp->showPhoto($item)?>	
		</td>
	</div>
	
	<td width='40%'>
		<a href ='/posterOne/<?=$item["id_poster"]?>'>
			<?=$item["title_p"]?>
		</a>
	</td>
	<td>
		<?= $pp->getTypePost($item['type_p']);unset($pp)?>
	</td>
	<td class="pNews10">
		<?=$item["date_p"]?>
	</td>
	<td>
		<b><?=$item["count_p"]?></b>
	</td>
</tr>