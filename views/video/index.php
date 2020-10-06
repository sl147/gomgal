<div class="container-fluid">
	<div class="row">
		<?php foreach ($videoList as $item) :?>
			<div class="videoRow">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<param name="movie" value="<?=$item['value']?>">
					<param name="allowFullScreen" value="true">
					<param name="allowscriptaccess" value="always">
					<embed src='<?=$item['value']?>' type="application/x-shockwave-flash" width="300" height="180" allowscriptaccess="always" allowfullscreen="true">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="YT"><?=$item['prhar']?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>