<?php if ($var) {?>
<<<<<<< HEAD

=======
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
<?php News::showNews($topNews)?>



<h3 class='text-center'>

	НОВИНИ

</h3>
<<<<<<< HEAD

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

=======
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
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
<?=Auxiliary::showReklRand()?>



<?php foreach ($allNewscat as $item) :?>

	<?php News::showNews($item)?>

<?php endforeach; ?>

<<<<<<< HEAD


<?php if($total > SHOWNEWS_BY_DEFAULT) {?>

<div class="text-center">

	<?php echo $pagination->get(); ?>

</div>

=======
<?php if($total > SHOWNEWS_BY_DEFAULT) {?>
<div class="text-center">
	<?php echo $pagination->get(); ?>
</div>
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
<?php } ?>