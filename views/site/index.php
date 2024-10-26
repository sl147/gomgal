<?php include 'views/layouts/hamburgerMenu.php';?>
<?php News::showNews($topNews)?>

<h3 class='text-center'>НОВИНИ</h3>
<div style="width: 100%;margin-bottom: 20px;"><?=Auxiliary::getAdSence()?></div>
<?php
foreach ($allNews as $item) {
	News::showNews($item);
}
?>
<?php if ($total > SHOWNEWS_BY_DEFAULT) :?>
	<div class="text-center">
		<? echo $pagination->get(); ?>
	</div>
<?php endif; ?>