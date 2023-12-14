<?php if ( isset($meta['title']) ) :?>

	<title><?= $meta['title']?></title>

	<meta name="keywords" content="<?= $meta['keywords']?>">

	<meta name="description" content="<?= $meta['descr']?>">
<?php else :?>
	<title><?= trim($_SERVER["REQUEST_URI"],'/')?></title>
<?php endif; ?>