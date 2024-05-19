<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php if (count($comm)) :?>
		<div class="news_Comment">Коментарів <?=count($comm)?></div>
		<?php foreach ($comm as $com) :?>
			<div class="news_Comment"><?=$com['txt_com']?></div>
			<p class='ip_Comment text-center'><?= ($com['comment_date'] > '2024-05-19 23:28:40') ?date_create($com['comment_date'])->Format('Y-m-d').' ' . $com['nik_com'] : $com['nik_com'] ?></p>
		<?php endforeach; ?>
	<?php else:?>
		<div class="news_Comment">Коментарів немає</div>
	<?php endif;?>
	<?php include_once 'views/news/formComment.php';?>
</div>