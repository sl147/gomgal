<tr class='text-center'>
	<?$p = new Poster();?>
	<?= $p->showPhoto($item)?>
	<td width='40%'>
		<a href ='/posterOne/<?=$item["id_poster"]?>'>
			<?=$item["title_p"]?>
		</a>
	</td>
	<td>
		<?= $p->getTypePost($item['type_p']);unset($p)?>
	</td>
	<td class="pNews10">
		<?=$item["date_p"]?>
	</td>
	<td>
		<b><?=$item["count_p"]?></b>
	</td>
</tr>