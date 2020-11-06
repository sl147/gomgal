
		
		<div class="col-lg-0 col-md-0 col-sm-2 col-xs-2">
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
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-10 col-xs-10">
			<nav class="main_menu clearfix">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">					
					<?php
						$p = new Poster();
						$p->showLineMenuPoster("posterFull","всі","всі безкоштовні оголошення");
						$p->showLineMenuPoster("posterCat","по категоріям","оголошення по категоріям");
						$p->showLineMenuPoster("posterFind","пошук","пошук безкоштовних оголошень");
						$p->showLineMenuPoster("posterAdd","додати","додати своє безкоштовне оголошення");
						unset($p);
					?>
				</div>
			</nav>
		</div>

