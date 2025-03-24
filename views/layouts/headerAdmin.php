<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="/libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="../libs/font-awesome-4.2.0/css/font-awesome.min.css" />
</head>
<body>
	<?php if ( !User::isGuest())  header ("Location: /userLogin"); ?>				
	<nav class="main_menu clearfix">
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<a href="/main" title="Головна" class="btn btn-delta11">ГОЛОВНА</a>
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					НОВИНИ<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php
						Auxiliary::showElementMenu("newsAdd","додати новину","додати новину");
						Auxiliary::showElementMenu("newsEdit","редагування новин","редагування новин");
						Auxiliary::showElementMenu("newsEditID","редагування новин за ID","редагування новин за ID");
						Auxiliary::showElementMenu("newsCatEdit","редагування категорій новин","категорій новин");
						Auxiliary::showElementMenu("newsCommentEdit","редагування коментарів","перегляд коментарів");
						Auxiliary::showElementMenu("userNews","редагування новин клієнтів","редагування новин клієнтів");
						Auxiliary::showElementMenu("userWishes","перегляд побажань клієнтів","перегляд побажань клієнтів");

						if ( (User::isGuest()) && (User::isGuest()['login'] == 'sl147adm')) {
							Auxiliary::showElementMenu("spam","перегляд spam","перегляд spam");
							Auxiliary::showElementMenu("spamEMail","перегляд spam email","перегляд spam email");
							Auxiliary::showElementMenu("newsFB","перегляд FB","перегляд FB");
							Auxiliary::showElementMenu("countUser","користувачі на сайті","користувачі на сайті");
					}
					?>
				<ul>
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					ДОЗВІЛЛЯ<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php
						Auxiliary::showElementMenu("relaxEdit","редагування дозвілля","редагування дозвілля");
						Auxiliary::showElementMenu("relaxCatAf","редагування категорій дозвілля","категорії дозвілля");
						Auxiliary::showElementMenu("relaxCatAn","редагування категорій анекдотів","категорії анекдотів")
					?>
				</ul>		
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					ФОТОАЛЬБОМИ<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a class="btn btn-block btn-info" href="/FAcreate" title="створення фотоальбому">створення фотоальбому</a>
					</li>
					<li>
						<a class="btn btn-block btn-info" href="/FAedit" title="редагування фотоальбомів">редагування фотоальбомів</a>
					</li>
					<?php Auxiliary::showElementMenu("FAdrugndrop","перетягування фото","перетягування фото");?>
					<?php Auxiliary::showElementMenu("FAdrugndropAll","перетягування фото","перетягування фото");?>
				</ul>			
			</div> 
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					ОГОЛОШЕННЯ<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php
					Auxiliary::showElementMenu("posterEdit","редагування оголошень","редагування оголошень");
					Auxiliary::showElementMenu("posterGr","редагування груп оголошень","групи оголошень");
					Auxiliary::showElementMenu("posterCatEd","редагування категорій оголошень","категорії оголошень");
					Auxiliary::showElementMenu("posterVerify","перевірка оголошень","перевірка оголошень")
					?>
				</ul>			
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					ВІДЕО<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php Auxiliary::showElementMenu("videoChange","редагування відео","редагування відео")?>
				</ul>			
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					голосування<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php
						Auxiliary::showElementMenu("voteActive","активне голосування","активне голосування");
						Auxiliary::showElementMenu("voteEdit","редагування категорій голосування","редагування голосування");
						Auxiliary::showElementMenu("voteShow","результати голосування","результати голосування");
					?>
				</ul>			
			</div>
			<div class="btn-group btn-group-justified">
				<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
					СЛУЖБОВІ<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php Auxiliary::showElementMenu("metaTags","редагування метатегів","редагування метатегів")?>
					<?php Auxiliary::showElementMenu("typeButton","редагування типів кнопок","редагування типів кнопок")?>
					<?php Auxiliary::showElementMenu("countClickButton","переходи по типах кнопок","переходи по типах кнопок")?>
					<?php Auxiliary::showElementMenu("checkFilesNews","Видалення фото","Видалення фото")?>
					<?php Auxiliary::showElementMenu("usersView","Перегляд користувачів","Перегляд користувачів")?>
					<?php Auxiliary::showElementMenu("outExcell","Вигрузка в Excell","Вигрузка в Excell")?>
				</ul>		
			</div>
			<?php if ( (User::isGuest()) && (User::isGuest()['login'] == 'sl147adm')) :?>
				<div class="btn-group btn-group-justified">
					<button type="button" data-toggle="dropdown" class="btn btn-delta11 dropdown-toggle">
						Калькулятори<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php Auxiliary::showElementMenu("calctypes","типи калькуляторів","Типи калькуляторів")?>
						<?php Auxiliary::showElementMenu("insuranceCommentEdit","редагування коментарів","Редагування коментарів")?>
						<?php Auxiliary::showElementMenu("cEdit","редагування мір калькуляторів","Редагування мір калькуляторів")?>
						<?php Auxiliary::showElementMenu("topBarlicensekey/112233","top bar","topbar")?>
					</ul>			
				</div>
			<?php endif ?>				
		</div>			
	</nav>
<div class="container-fluid">
	<div class="row">