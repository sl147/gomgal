<div class='lastNews showNews text-center'>
	останні новини
</div><br>
<div class='showRekl'>
	<?=Auxiliary::showReklamaArg('https://www.artargus.in.ua/insurance','velocityProduct','калькулятор автоцивілки','розрахунок вартості страхування автоцивілки')?>
</div>
<div class='leftR'>
	<?php foreach (News::getNews() as $item) :?>
		<div class='bordLeft media'>
			<?php if ($item['fotoF']) :?>
				<?php if (Auxiliary::isFile($item["foto"])) :?>
					<a class='media-left media-top' href='/Fullnew/<?=$item["id"]?>'>
						<img alt='фото новини' width='60' height='60' src='<?="/".$item["foto"]?>' title='<?=$item["title"]?>'>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($item['top']==1) :?>
				<a class='media-body' href='/Fullnew/<?=$item["id"]?>'>
					<b>
						<p class='text-danger'>
							<?=$item["title"]?>								
						</p>
					</b>
				</a>
			<?else :?>
				<a class='media-body transbox' href='/Fullnew/<?=$item["id"]?>' title='<?=$item["title"]?>'>
					<?=$item["title"]?>						
				</a>	
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>