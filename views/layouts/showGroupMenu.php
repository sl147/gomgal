<div class="btn-group btn-group-justified">

	<?php Auxiliary::showMainCaretMenu($nameElMenu)?>

<?php
/* function list_sort($a, $b){
 	return ($a['NAME'] > $b['NAME']);
 }
 uasort($arrData, 'list_sort');*/


/*echo "<pre>";
var_dump($arrData);
echo "</pre>"*/
 ?>
	<ul class="dropdown-menu">

		<?php foreach ($arrData as $item)

		Auxiliary::showElementMenu($href.'/'.$item ['id'],$item['name'],$item['name'])

		?>

	</ul>	

</div>