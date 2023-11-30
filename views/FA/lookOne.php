<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotoLook").lazyload({
      effect: "fadeIn"
    });
  });
</script>
<h2 class='text-center'>
	<?=$nameFA['name_FA']?>	
</h2>
<div class="container-fluid">
	<div class="row">
			<?php foreach ($faList as $item) :?>
				<div class="text-center col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<a class="fancybox" data-fancybox-group="group" href="<?=$item['fotoName']?>">
						<img class='fotoLook' src="<?=$item['fotoName']?>" title="<?=$item['subscribe']?>"/>
					</a>
					<p style="color: grey" class="text-center">
						<?=$item['subscribe']?>						
					</p>					
				</div>
			<?php endforeach; ?>
	</div>
</div>