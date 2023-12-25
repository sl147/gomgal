<div class="showLarge">
	<h1 class='text-center'>
		<?= strip_tags($news['title'])?>
	</h1>
</div>

<div class="showSmall">
	<h4 class='text-center'>
		<?= strip_tags($news['title'])?>
	</h4>
</div>

<p class="pNews10">
	<?= strip_tags($news['datetime'])?>
</p>
<div>
<?=Auxiliary::getAdSence()?>
<div class='news_msg text-justify'>
	<?php if ($news['foto']) :?>
		<img class='imgNews' width="200" height="auto" src="<?=$news['photo']?>" title="<?=$news['title']?>" alt="<?=$news['title']?>" />
	<?php endif; ?>
	<?= $news['msg'] ?>
</div>
</div>
<?php if ($news['videoYT']) :?>
	<div class="text-center" style="padding-top: 20px;">
		<object width="300" height="169">
			<param name="movie" value="<?=$news['video']?>">
			<param name="allowFullScreen" value="true">
			<param name="allowscriptaccess" value="always">
			<embed src="<?=$news['video']?>" type="application/x-shockwave-flash" width="450" height="254" allowscriptaccess="always" allowfullscreen="true"></embed>
		</object>
	</div><br>
<?php endif; ?>
<div class='sourse'>
	<p>
		джерело: <?= strip_tags($news['sourse'])?>
	</p>

	<div class="showLarge">
		<a href='/newsPrint/<?=$news["id"]?>' target='_blank'>
			<img style="float: left;" alt='версія для друку' title='версія для друку' src='../image/print.jpg'>
			<div style="float: right;">
				версія<br>для друку
			</div>
		</a>
	</div>
</div><br><br><br>