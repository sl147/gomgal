<?php
$content ="<div class=' btn-group btn-group-justified' role='group' aria-label='...'>
    <a href='/' title='ГОЛОВНА' class='btn btn-info'>ГОЛОВНА</a>
    <a href='/relax/1' title='ДОЗВІЛЛЯ' class='btn btn-info'>ДОЗВІЛЛЯ</a>
</div>";
$nm = "меню";
?> 

<div class='showSmall'>		
		<div class='text-left'>
			<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg" data-container="body" role="button" data-toggle="popover" 
			data-placement="right" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
			<i class="fa fa-bars fa-fw"></i>
			</a>
		</div>		
</div>

<nav class="main_menu clearfix">
	
	<div class="menuMain btn-group btn-group-justified" role="group" aria-label="...">
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
