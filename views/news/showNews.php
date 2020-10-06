<?php if ($arrNews['width']) :?>
	<div class='news_Text'>
		<a href='/Fullnew/<?=$arrNews["id"]?>'>
			<img alt='<?=$arrNews["title"]?>' width='<?=$arrNews["width"]?>' height='<?=$arrNews["height"]?>' src='<?="/".$arrNews["foto"]?>' title='<?=$arrNews["title"]?>'>
		</a>
	</div>
<?php endif; ?>
<div class='news_Tit'>
	<a class='adecor' href='/Fullnew/<?=$arrNews["id"]?>' title='<?=$arrNews["title"]?>'>
		<?=$arrNews["title"]?>
	</a>
</div>
<p class="pNews15"><?=$arrNews["prew"]?> .....
	<a class='adecor' href='/Fullnew/<?=$arrNews["id"]?>'>
		читати більше
	</a>
</p>
<p class="pNews10">
	джерело: <?=$arrNews["sourse"]?>
</p><br>
<p class="pNews10">
	<?=$arrNews["datetime"]?> переглядів 
	<span class='badge'>
		<?=$arrNews["countmsgs"]?>
	</span>
	 ----------------------------------------------------------
</p><br>