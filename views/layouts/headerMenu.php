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