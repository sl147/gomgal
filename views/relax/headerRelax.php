<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-0"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-0">
			<div class="btn-group btn-group-justified">
				<a href="/relaxALL" class="btn btn-danger">
					всі
				</a>

				<div class="btn-group btn-group-justified">
					<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
						по темам<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php foreach (Relax::getAnList() as $item) :?>
							<li>
								<a href="/relaxFullAnCat/<?=$item ['id']?>" title="<?$item['name']?>">
									<?=$item['name']?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>			
				</div>

				<a href="/ralaxAddAn" class="btn btn-success">
					додати анекдот
				</a>
			</div>
		</div>	
	</div>	
</div>
<br><br>