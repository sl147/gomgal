<?php include 'views/layouts/hamburgerMenu.php';?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="btn-group btn-group-justified">
				<a href="/relaxALL" class="btn btn-danger">всі</a>
				<div class="btn-group btn-group-justified">
					<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
						по темам<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?$r = new Relax();
						foreach ($r->getAnList() as $item) :?>
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