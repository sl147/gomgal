<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img").lazyload({
      effect: "fadeIn"
    });
  });
</script>

<?php include 'views/layouts/hamburgerMenu.php';?>

<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="text-center showLarge">
						<?=$nameFA['name_FA']?>	
					</h2>
					<h4 class="text-center showSmall">
						<?=$nameFA['name_FA']?>	
					</h4>
				</div>
			</div>
		</div>
<div class="container-fluid">
	<div class="row">
			<?php $j=0; foreach ($faList as $item) :?>
				<div class="text-center col-lg-6 col-md-6 col-sm-12 col-xs-12" style='margin-bottom:20px;'>
					<a class="fancybox" data-fancybox-group="group" href="<?=$item['fotoName']?>">
						<img class='fotoLook' src="<?=$item['fotoName']?>" title="<?=$item['subscribe']?>"/>
					</a>
					<p style="color: grey" class="text-center">
						<?=$item['subscribe']?>
					</p>					
				</div>
				
				<?php $j++; if($j == 4) :?>
					<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
					<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10" style='margin-bottom:20px;'>
								<?=Auxiliary::getAdSence()?>
					</div>
				<?php endif;?>
			<?php endforeach; ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
	<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
				<?=Auxiliary::getAdSence()?>
	</div>
</div>