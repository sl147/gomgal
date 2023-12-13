<?php if ( (isset($meta['url_name'])) && (trim($_SERVER["REQUEST_URI"],'/') == $meta['url_name']) ) :?>

	<title><?= $meta['title']?></title>

	<meta name="keywords" content="<?= $meta['keywords']?>">

	<meta name="description" content="<?= $meta['descr']?>">
<?php else :?>
	<title><?= trim($_SERVER["REQUEST_URI"],'/')?></title>
<?php endif; ?>