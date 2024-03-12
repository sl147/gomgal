<?php
//var_dump(explode("/",trim($_SERVER["REQUEST_URI"],'/')));
//var_dump($meta);
?>
<?php if ($siteFile  != 'views/news/fullNew.php') :?>
	<?php if ( isset($meta['title']) ) :?>

		<title><?= $meta['title']?></title>

		<meta name="keywords" content="<?= $meta['keywords']?>">

		<meta name="description" content="<?= $meta['descr']?>">
	<?php else :?>
		<title><?= trim($_SERVER["REQUEST_URI"],'/')?></title>
	<?php endif; ?>
<?php endif; ?>