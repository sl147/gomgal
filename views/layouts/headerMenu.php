<!-- <?
$content="<div class='text-center'>";

$content .="
<a href='/' title='Головна' class='hamburgerMenu text-menu btn btn-info'>Головна</a>
<a href='/basket' title='Перейти до кошика' class='hamburgerMenu text-menu btn btn-info'>Кошик</a>
<a href='/contakt' title='контакти' class='hamburgerMenu text-menu btn btn-info'>контакти</a>
<a href='/jobList' title='Роботи наших клієнтів' class='hamburgerMenu text-menu btn btn-info'>Галерея</a>
</div>    
";
$nm = "меню";
?>
<div class="col-lg-2 col-md-3 col-sm-0 col-xs-0">
	<div class='hamburgerAdmin'>
		<div class='text-left'>
			<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg" data-container="body" role="button" data-toggle="popover" 
			data-placement="bottom" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
			<span title="меню" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
			</a>
		</div>
	</div>	
</div> -->
<nav class="main_menu clearfix">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<?php
		$n = new News();
		$r = new Relax();
		Auxiliary::showMainElMenu("main","Головна","ГОЛОВНА");

		Auxiliary::showGroupMenu("НОВИНИ","newscat",$n->getCatNews());
		Auxiliary::showGroupMenu("ДОЗВІЛЛЯ","relax",$r->getRelax());

		Auxiliary::showMainElMenu("FAlook","перегляд фотоальбомів Галичини","ФОТОАЛЬБОМИ");
		Auxiliary::showMainElMenu("posterCat","безкоштовні оголошення","ОГОЛОШЕННЯ");
		Auxiliary::showMainElMenu("video","відео з Дрогобича","ВІДЕО");
		Auxiliary::showMainElMenu("contakt","контакти","КОНТАКТИ");
		if (!User::isGuest ())
			Auxiliary::showMainElMenu("userLogin","вхід","ВХІД");  
		?> 
	</div>			
</nav>