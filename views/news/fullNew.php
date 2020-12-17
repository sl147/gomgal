<!-- <script type="text/javascript">
	window.___gcfg = {lang: 'uk'};
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/platform.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
</script> -->			
<div class="container-fluid">
	<div class="row">
		<?php include 'views/layouts/hamburgerMenu.php';?>						
		<div class="col-lg-12 col-md-12 col-sm-9 col-xs-9">	
			<?=Auxiliary::showReklRand()?>						
		</div>				
	</div>
</div>
<?php include_once 'views/news/newsMsg.php';?>
<?php include_once 'views/news/socialMedia.php';?>
<?php include_once 'views/news/newsElse.php';?>
<?php include_once 'views/news/newsComment.php';?>