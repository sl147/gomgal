<div class="container-fluid">
	<div class="row">
		
		<?php include 'views/layouts/hamburgerMenu.php';?>
		
		<?php foreach ($videoList as $item) :?>
			<?php $count_ads +=1;?>
			<div class="videoRow" id="<?= $item['prid']?>">
				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
					<param name="movie" value="<?=$item['value']?>">
					<param name="allowFullScreen" value="true">
					<param name="allowscriptaccess" value="always">
					<div class="showLarge">
						<embed src='<?=$item['value']?>' type="application/x-shockwave-flash" width="500" height="240" allowscriptaccess="always" allowfullscreen="true">
					</div>
					<div class="showSmall">
						<embed src='<?=$item['value']?>' type="application/x-shockwave-flash" width="100%" height="240" allowscriptaccess="always" allowfullscreen="true">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="YT"><?=$item['prhar']?></div>
				</div>
<!-- 				<?php if($count_ads == 3 ) :?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 60px;">	
					<?=Auxiliary::showReklRand()?>						
				</div>					
			<?php endif; ?> -->
			</div>
					
		<?php endforeach; ?>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<?=Auxiliary::showReklRand()?>						
</div>
<?php if ($this->total > SHOWVIDEO_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?endif ;?>