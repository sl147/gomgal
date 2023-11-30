<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if (count($meta)) :?>
		<title><?= $meta['title']?></title>
		<meta name="keywords" content="<?= $meta['keywords']?>">
		<meta name="description" content="<?= $meta['descr']?>">
	<?php else:?>
		<title>Калькулятор автоцивілки</title>
	<?php endif; ?>
	
	<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="/css/main_ins.css" />
	<link rel="stylesheet" href="/css/media_ins.css" />
	<link rel="stylesheet" href="/css/bootstrap-vue.css" />
</head>
<body>