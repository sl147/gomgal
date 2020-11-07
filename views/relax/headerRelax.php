<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<?php include 'views/layouts/hamburgerMenu.php';?>
		<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
			<div class="btn-group btn-group-justified">
				<a href="/relaxALL" class="btn btn-danger">всі</a>
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