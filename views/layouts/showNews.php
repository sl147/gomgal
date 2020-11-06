<?php
$content ="<div class=' btn-group btn-group-justified' role='group' aria-label='...'>
    <a href='/' title='ГОЛОВНА' class='btn btn-info'>ГОЛОВНА</a>
    <a href='/relax/1' title='ДОЗВІЛЛЯ' class='btn btn-info'>ДОЗВІЛЛЯ</a>
</div>";
$nm = "меню";
?> 
<div class='col-lg-0 col-md-0 col-sm-2 col-xs-2'>
<div class='showSmall'>		
		<div class='text-left'>
			<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg" data-container="body" role="button" data-toggle="popover" 
			data-placement="right" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
			<i class="fa fa-bars fa-fw"></i>
			</a>
		</div>		
</div>
</div>
<div class='col-lg-12 col-md-12 col-sm-10 col-xs-10'>
<div class='lastNews showNews text-center'>
	останні новини
</div>
</div>
<br>
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