<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script data-ad-client="pub-9370914710542990" async src="https://pagead2.googlesyndication.com/
pagead/js/adsbygoogle.js"></script>
	<?php if ($siteFile == 'views/news/fullNew.php') :?>
		<meta property="og:url"         content="<?php echo $fb?>" />
		<meta property="og:type"        content="article" />
		<meta property="og:title"       content="<?=$news['title']?>" />
		<meta property="og:description" content="<?=$news['prew']?>" />
		<meta property="og:image"       content="<?='https://www.gomgal.lviv.ua'.$news['photo']?>" />
		<title><?= $news['title']?></title>
		<meta name="description" content="<? echo $meta['descr']?>">
		<meta name="keywords" content="<? echo $meta['keywords']?>">
	<?php elseif ( ($siteFile == 'views/user/index.php') || ($siteFile == 'views/user/author.php') ) :?>
		<meta name="robots" content="noindex, follow" />
	<?php else :?>
		<?php include 'views/layouts/showMeta.php';?>		
	<?php endif; ?>
	
	<link rel="canonical" href="https://www.gomgal.lviv.ua/<?echo trim($_SERVER["REQUEST_URI"],'/');?>" />
	<link rel="stylesheet" @media all href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" @media all href="/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" @media all href="/css/fonts.css" />
	<link rel="stylesheet" @media all href="/css/main.css" />
	<link rel="stylesheet" @media all href="/css/media.css" />
	<link rel="stylesheet" @media all href="/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="/js/lazyload.js"></script>
	<script data-ad-client="ca-pub-9370914710542990" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9370914710542990"
     crossorigin="anonymous"></script>
</head>