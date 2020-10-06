<tr class='text-center'>
	<?=Poster::showPhoto($item)?>
	<td width='40%'>
		<a href ='/posterOne/<?=$item["id_poster"]?>'>
			<?=$item["title_p"]?>
		</a>
	</td>
	<td>
		<?=Poster::getTypePost($item['type_p'])?>
	</td>
	<td class="pNews10">
		<?=$item["date_p"]?>
	</td>
	<td>
		<b><?=$item["count_p"]?></b>
	</td>
</tr>