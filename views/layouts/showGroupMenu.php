<div class="btn-group btn-group-justified">
	<?php Auxiliary::showMainCaretMenu($nameElMenu)?>
	<ul class="dropdown-menu">
		<?php foreach ($arrData as $item)
		Auxiliary::showElementMenu($href.'/'.$item ['id'],$item['name'],$item['name'])
		?>
	</ul>	
</div>