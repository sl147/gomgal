<tr class='text-center'>
	<?$pp = new Poster();?>
		<td class="showLarge">
			<?= $pp->showPhoto($item)?>	
		</td>	
	<td width='40%'>
		<a href ='/posterOne/<?=$item["id_poster"]?>'>
			<?=$item["title_p"]?>
		</a>
	</td>
	<td>
		<?= $pp->getTypePost($item['type_p']);unset($pp)?>
	</td>
	<td class="pNews10 showLarge">
		<?=$item["date_p"]?>
	</td>
	<td class="showLarge">
		<b><?=$item["count_p"]?></b>
	</td>
</tr>