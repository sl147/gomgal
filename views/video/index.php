<div class="container-fluid">
	<div class="row">
		<div class="container-fluid">
			<div class="row">
				<?php include 'views/layouts/hamburgerMenu.php';?>						
					<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">	
						<div class="btn-group btn-group-justified">		
							<h1 class="text-left">відео</h1>
						</div>
					</div>
				</div>
			</div>
		
		<?php foreach ($videoList as $item) :?>
			<div class="videoRow">
				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
					<param name="movie" value="<?=$item['value']?>">
					<param name="allowFullScreen" value="true">
					<param name="allowscriptaccess" value="always">
					<div class="showLarge">
						<embed src='<?=$item['value']?>' type="application/x-shockwave-flash" width="500" height="240" allowscriptaccess="always" allowfullscreen="true">
					</div>
					<div class="showSmall">
						<embed src='<?=$item['value']?>' type="application/x-shockwave-flash" width="240" height="180" allowscriptaccess="always" allowfullscreen="true">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="YT"><?=$item['prhar']?></div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>

<?php if ($this->total > Video::SHOWVIDEO_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?endif ;?>