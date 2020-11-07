<?php include 'views/layouts/hamburgerMenu.php';?>	
<div class="col-lg-12 col-md-12 col-sm-10 col-xs-10">
	<nav class="main_menu clearfix">
		<div class="btn-group btn-group-justified" role="group" aria-label="...">					
			<?php
				$p = new Poster();
				$p->showLineMenuPoster("posterFull","всі","всі безкоштовні оголошення");
				$p->showLineMenuPoster("posterCat","категорії","оголошення по категоріям");
				$p->showLineMenuPoster("posterFind","пошук","пошук безкоштовних оголошень");
				$p->showLineMenuPoster("posterAdd","додати","додати своє безкоштовне оголошення");
				unset($p);
			?>
		</div>
	</nav>
</div>