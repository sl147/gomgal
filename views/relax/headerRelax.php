<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
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
		<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
			<div class="btn-group btn-group-justified">
				<a href="/relaxALL" class="btn btn-danger">
					всі
				</a>

				<div class="btn-group btn-group-justified">
					<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
						по темам<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?$r = new Relax();?>
						<?php foreach ($r->getAnList() as $item) :?>
							<li>
								<a href="/relaxFullAnCat/<?=$item ['id']?>" title="<?$item['name']?>">
									<?=$item['name']?>
								</a>
							</li>
						<?php endforeach; unset($r);?>

					</ul>			
				</div>

				<a href="/ralaxAddAn" class="btn btn-success">
					<div class="showLarge">додати анекдот</div>
					<div class="showSmall">додати</div>
				</a>
			</div>
		</div>	
	</div>	
</div>
<br><br>