<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script type=text/javascript>
            function setScreenHWCookie() {
            	Cookies.set('sw', window.innerWidth)
            	Cookies.set('sh', window.innerHeight)
                /*$.cookie('sw',screen.width);
                $.cookie('sh',screen.height);*/
                return true;
            }
            setScreenHWCookie();
</script>

<?php include 'views/layouts/hamburgerMenu.php';?>

<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	<form method='POST' action="/findNews" class="form_find">
		<div class="input-group margin-bottom-sm">
			<input class="btnwidth sl147_find" name="name_f" type="text" placeholder="Введіть текст для пошуку" required>
			<span class="input-group-addon find_bcg">
				<button name="submit" type="submit" class="search-submit find_bcg">
					<i class="fa fa-search fa-fw"></i>
				</button>
			</span>
		</div>
</form>
<div class='lastNews text-center'>останні новини</div>

</div>
<br>

<div class='leftR'>
	<?php $j=1; foreach (News::getNews() as $item) :?>
		<div class='bordLeft media'>
			<?php if ($item['fotoF']) :?>
				<?php if (file_exists($item["foto"])) :?>
					<a class='media-left media-top' href='/Fullnew/<?=$item["id"]?>'>
						<img class="imgLazy" alt='завантажується...' width='60' height='auto' data-src='<?="/".$item["foto"]?>' title='<?=$item["title"]?>'>
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
				<a class='media-body' href='/Fullnew/<?=$item["id"]?>' title='<?=$item["title"]?>'>
					<?=$item["title"]?>						
				</a>	
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>