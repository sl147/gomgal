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
<<<<<<< HEAD
		<div class="input-group margin-bottom-sm">
=======

		<div class="input-group margin-bottom-sm">

>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
			<input class="btnwidth sl147_find" name="name_f" type="text" placeholder="Введіть текст для пошуку" required>
			<span class="input-group-addon find_bcg">
				<button name="submit" type="submit" class="search-submit find_bcg">
					<i class="fa fa-search fa-fw"></i>
				</button>
			</span>
<<<<<<< HEAD
=======
		</div>
</form>
<div class='lastNews text-center'>
	останні новини
</div>
</div>
<br>
<div class="showSmall">
	<br><br>
	<div class="row ">
		<?php include 'views/layouts/hamburgerMenu.php';?>	
		<div class='col-lg-0 col-md-0 col-sm-1 col-xs-1'></div>
		<div class='col-lg-0 col-md-0 col-sm-6 col-xs-6'>
			<a href="https://www.artargus.in.ua/insurance" target='_blank'>
				<img class='insImgSize' height="50" width="auto" src="../image/autosmall.png" alt="калькулятор автоцивілки">
			</a>		
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
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