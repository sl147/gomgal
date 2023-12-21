<?php include 'views/layouts/headerAdmin.php';?>
<h1>check</h1>
<?php
for ($i=1; $i < count($news); $i++) {
	echo "<br>     i=$i ".$news[$i];
}

	?>
<?php include 'views/layouts/footerAdmin.php';?>