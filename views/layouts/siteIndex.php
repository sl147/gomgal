
<html>
	<head>
		<?php include 'views/layouts/showHead.php';?>
	</head>
	<body>
		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/myjs.js"></script>
		<?php include 'views/layouts/hamburgerMenu.php';?>
		<div class="showLarge">
			<header>
				<div class="header_topline">
					<?php include 'views/layouts/headerLine.php' ?>					
				</div>
			</header>	
		</div>		
		<div class="container-fluid">
			<div class="row">
				<div class='showLarge col-lg-3 col-md-3 col-sm-12 col-xs-12'>
					<?php include 'views/layouts/leftSide.php';?>
				</div>
				<div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>
					<?php include $siteFile;?>
				</div>
				<div class='showLarge col-lg-2 col-md-2 col-sm-12 col-xs-12'>
					<?php include 'views/layouts/rightSide.php';?>
				</div>
			</div>
		</div>
		<div class="showSmall">
			<div class="row">
				<div class='col-sm-3 col-xs-3'></div>
				<div class='col-sm-6 col-xs-6'>
					<?=Auxiliary::showArchive()?>
				</div>
			</div>
		</div>
		<?php include 'views/layouts/showBodyBottom.php';?>
	</body>
</html>