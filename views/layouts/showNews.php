<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script type=text/javascript>
            function setScreenHWCookie() {
            	Cookies.set('sw', window.innerWidth)
            	Cookies.set('sh', window.innerHeight)
                /*$.cookie('sw',screen.width);
                $.cookie('sh',screen.height);*/
                //alert('cookie width='+ Cookies.get('sw'))
                return true;
            }
            setScreenHWCookie();
</script>
<!-- <script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.imgLazy").lazyload({
      effect: "fadeIn"
    });
  });
</script> -->
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
		<form method='POST'>
	<br><input type="text" style="width: 100%;" name="name_f" placeholder="Введіть текст для пошуку"><br><br>
	<input name="_token" type="hidden" value="<?= $token?>">
	<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
	 	Знайти
	</button>
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
			<a href="https://www.gomgal.lviv.ua/insurance" target='_blank'>
				<img class='insImgSize' height="50" width="auto" src="../image/autosmall.png" alt="калькулятор автоцивілки">
			</a>		
		</div>
				
	</div>		
</div>
<div class='leftR'>
	<?php foreach (News::getNews() as $item) :?>
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