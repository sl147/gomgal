<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

	<?php if (isset($meta)) :?>
		<title><?= $meta['title']?></title>
		<meta name="keywords" content="<?= $meta['keywords']?>">
		<meta name="description" content="<?= $meta['descr']?>">
	<?php else:?>
		<title>Гомін Галичини</title>
	<?php endif; ?>

	<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="/css/fonts.css" /> 
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/media.css" />
</head>
<div style="width: 700px;padding-left: 20px;">
	<h1 class='text-center'>
		<?=$news['title']?>	
	</h1>
	<p class="pNews10">
		<?=$news['datetime']?>	
	</p>
	<?php if ($news['photo']) :?>
		<img class='imgNews' width="300" height="auto" src="<?=$news['photo']?>" alt="<?=$news['title']?>" />
	<?php endif; ?>

	<p class='text-justify'>
		<?=$news['msg']?>	
	</p>

	<p class='sourse'>
		джерело: <?=$news['sourse']?>	
	</p>
</div>
