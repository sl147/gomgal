<script>
	document.cookie = "sw="+window.innerWidth;
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
			<div>
				<a href="/topBar/en" class="textwidth btn btn-primary btn-block">En</a>
				<a href="/topBar/pl" class="textwidth btn btn-primary btn-block">Pl</a>
				<a href="/topBar/uk" class="textwidth btn btn-primary ">Укр</a>
			</div>

		</div>
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>	
			<h2 class="text-center">Simple Top Bar</h2>
			<ul class="nav nav-tabs" style="margin-left: 0; margin-bottom: 20px;">

				<li class="active">
					<a style="color: #337ab7;" data-toggle="tab" href="#myTab">
						<strong><?php echo $this->Translate('Details')?></strong>
					</a>
				</li> 
				<li>
					<a style="color: #337ab7;" data-toggle="tab" href="#opinian">
						<strong><?php echo $this->Translate('Reviews')?></strong>
					</a>
				</li>

				<li>
					<a style="color: #337ab7;" data-toggle="tab" href="#instalation">
						<strong><?php echo $this->Translate('Installation')?></strong>
					</a>
				</li>

			</ul>

			<div class="tab-content">
				<div id="myTab" class="tab-pane fade in active">
					<ul>
					<li><?php echo $this->Translate('Simple Top Bar will allows you to display a nice top bar in your site')?></li>
					<li><?php echo $this->Translate('In the plugin settings, you can set the following options:')?></li>
					<li><?php echo $this->Translate('Background color')?></li>
					<li><?php echo $this->Translate('Font color')?></li>
					<li><?php echo $this->Translate('Text in the bar')?></li>
					<li><?php echo $this->Translate('Active bar')?></li>
					<li><?php echo $this->Translate('Active bar non stop')?></li>
					<li><?php echo $this->Translate('Bar width (%%)')?></li>
					<li><?php echo $this->Translate('Border radius (px)')?></li>
					<li><?php echo $this->Translate('Position')?></li>
					<li><?php echo $this->Translate('UpDown')?></li>
					<li><?php echo $this->Translate('Font size (px)')?></li>
					<li><?php echo $this->Translate('Height top bar (px)')?></li>
				</ul>

					<p>author <a target="_blank" href="https://profiles.wordpress.org/sl147">Yaroslav Livchak</a> </p>
				</div>
				<div id="opinian" class="tab-pane fade">
					<? if (empty($comment)) :?>
						<div class="text-center">
							<h4><?php echo $this->Translate('There are no reviews')?></h4>
						</div>
					<? else :?>

						<h5 class="text-center"><?php echo $this->Translate('Reviews')?> <?= count($comment)?></h5>
						<?php foreach ($comment as $item) :?>

							<p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
							<p class="news_Comment"><?=$item['text'] ?></p>
							<br>
						<?php endforeach; ?>	
					<? endif; ?>
					<form id = "formCom" method="POST">
						<fieldset>
							<legend class="text-center"><?php echo $this->Translate('Add a comment')?></legend>
							<label style="width: 80px;" class="text-center"><?php echo $this->Translate('Name')?></label>
							<input style="width: 200px;" name="nik_com" type="text"><br><br>
							<label style="width: 80px;" class="text-center"><?php echo $this->Translate('Comment')?></label>
							<textarea style="width: 200px;" name = "txt_com" rows ='3' maxlength="2000"></textarea>
							<input id="check" name="check" type="hidden" value="" />
							<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block"><?php echo $this->Translate('Submit')?></button></div>
						</fieldset>
					</form><br>	
				</div>
				<div id="instalation" class="tab-pane fade">
					<p style="text-indent: 20px;">
						<?php echo $this->Translate("Upload the plugin to your page. Activate it. Place the shortcode ['sl147_TB_display'] on your page where you want to see it and that will be enough.")?> 
					</p>
				</div>
			</div>	
		</div>
			
	</div>
</div>

<script src="/js/jquery-1.11.3.min.js"></script>
<!-- <script src="/libs/jquery/jquery-1.11.3.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
