<html>	
	<?php include 'views/layouts/showHead.php';?>
	<?php include 'views/layouts/showBodyTop.php';?>		
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
	<?php include 'views/layouts/showBodyBottom.php';?>
</html>