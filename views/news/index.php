<?php News::showNews($topNews)?>

<h3 class='text-center'>
	НОВИНИ
</h3>

<?=Auxiliary::showReklRand()?>

<?php foreach ($allNewscat as $item) :?>
	<?php News::showNews($item)?>
<?php endforeach; ?>

<?php if (count($allNewscat) > SHOWNEWS_BY_DEFAULT) :?>
	<div class="text-center">
		<? echo $pagination->get(); ?>
	</div>
<?php endif; ?>