<?php if ($var) {?>
<?php News::showNews($topNews)?>

<h3 class='text-center'>
	НОВИНИ
</h3>
<?php } else {
	if(count($allNewscat)) {
	?>
	<h3 class='text-center'>
		Результати пошуку <br>"<?php echo $txt_find ?>"
	</h3>
<?php }else{ ?>
	<h3 class='text-center'>
		За Вашим запитом нічого не знайдено
	</h3>
<?php }}?>
<?=Auxiliary::showReklRand()?>

<?php foreach ($allNewscat as $item) :?>
	<?php News::showNews($item)?>
<?php endforeach; ?>

<?php if($total > SHOWNEWS_BY_DEFAULT) {?>
<div class="text-center">
	<?php echo $pagination->get(); ?>
</div>
<?php } ?>