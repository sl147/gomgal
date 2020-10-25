<div class="showLarge">
<h1 class='text-center'>
	<?=$news['title']?>
</h1>
</div>

<div class="showSmall">
<h4 class='text-center'>
	<?=$news['title']?>
</h4>
</div>

<p class="pNews10">
	<?=$news['datetime']?>
</p>
<?php if ($news['foto']) :?>
	<a class="fancybox" data-fancybox-group="group" href="<?=$news['photo']?>">
		<img class='imgNews' src="<?=$news['photo']?>" alt="<?=$news['title']?>" />
	</a>
<?php endif; ?>

<div class='news_msg text-justify'>
	<?=$news['msg']?>
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
		джерело: <?=$news['sourse']?>
	</p>
	<a href='/newsPrint/<?=$news["id"]?>' target='_blank'>
		<img style="float: left;" alt='версія для друку' title='версія для друку' src='../image/print.jpg'>
		<div style="float: right;">
			версія<br>для друку
		</div>
	</a>
</div><br><br><br>