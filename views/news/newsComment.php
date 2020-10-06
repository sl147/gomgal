<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php if (count($comm)) :?>
		<div class="news_Comment">Коментарів <?=count($comm)?></div>
		<?php foreach ($comm as $com) :?>
			<div class="news_Comment"><?=$com['txt_com']?></div>
			<p class='ip_Comment text-center'><?=$com['nik_com']?></p>
		<?php endforeach; ?>
	<?php else:?>
		<div class="news_Comment">Коментарів немає</div>
	<?php endif;?>
	<?php include_once 'views/news/formComment.php';?>
</div>