<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotoLook").lazyload({
      effect: "fadeIn"
    });
  });
</script>

<?php include 'views/layouts/hamburgerMenu.php';?>

<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="text-center">
						<?=$nameFA['name_FA']?>	
					</h2>
				</div>
			</div>
		</div>
<div class="container-fluid">
	<div class="row">
			<?php $j=0; foreach ($faList as $item) :?>
				<div class="text-center col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<a class="fancybox" data-fancybox-group="group" href="<?=$item['fotoName']?>">
						<img class='fotoLook' src="<?=$item['fotoName']?>" title="<?=$item['subscribe']?>"/>
					</a>
					<p style="color: grey" class="text-center">
						<?=$item['subscribe']?>						
					</p>					
				</div>
				
				<?php $j++; if($j == 4) :?>
				<div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ads">
						<?=Auxiliary::getAdSence()?>
					</div>
				</div>
				<?php endif;?>
			<?php endforeach; ?>
	</div>
</div>