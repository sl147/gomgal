<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotoLook").lazyload({
      effect: "fadeIn"
    });
  });
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
			<h2 class="text-center">
				ФОТОАЛЬБОМИ
			</h2>
			<table class="table table-responsive table-striped table-hover">
				<tbody>
					<?php foreach ($faList as $item) :?>
						<tr>
							<td>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<a href="/FAlookOne/<?=$item ['id']?>" title="<?$item['name']?>">
											<img class="fotoLook" src="<?=$item ['fns']?>">
										</a>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<a href="/FAlookOne/<?=$item ['id']?>" title="<?$item['name']?>">
											<?=$item['name']?>
										</a>
									</div>
								</div>									
							</td>
						</tr>	
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php if ($total > SHOWFA_BY_DEFAULT) :?>
				<div class="text-center"><? echo $pagination->get(); ?></div>
			<?endif ;?>
		</div>
	</div>
</div>