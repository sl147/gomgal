<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if (isset($news)) :?>
			<?=Auxiliary::showMeta($metaTags,$news)?>
		<?php elseif (isset($posterOne)) : ?>
			<?=Auxiliary::showMeta($metaTags,$posterOne)?>
		<?php else : ?>
			<?=Auxiliary::showMeta($metaTags)?>
		<?php endif; ?>
		<link rel="stylesheet" @media all href="/libs/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" @media all href="/libs/fancybox/jquery.fancybox.css" />
		<link rel="stylesheet" @media all href="/css/fonts.css" />
		<link rel="stylesheet" @media all href="/css/main.css" />
		<link rel="stylesheet" @media all href="/css/media.css" />
		<link rel="stylesheet" @media all href="/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/myjs.js"></script>
		<?php
		include 'views/layouts/headerLine.php';
		include 'views/layouts/headerMenu.php';
		?>

		<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
			<?php include 'views/layouts/leftSide.php';?>
		</div>

			<div class="showLarge">
				<div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
					<div>
						<?php include $siteFile;?>
					</div>
				</div>

				<div class='col-lg-2 col-md-2 col-sm-12 col-xs-12'>
					<?php include 'views/layouts/rightSide.php';?>
				</div>
			</div>
<!-- 			<div class="showSmall">
				<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>

					<?php include $siteSmall;?>
				</div>
			</div>	 -->

		<?php include 'views/layouts/footer.php';?>		

		<script src="/libs/fancybox/jquery.fancybox.pack.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/vue.min.js"></script>
		<script src="/js/vue-resource.min.js"></script>
	</body>
</html>