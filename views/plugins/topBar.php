<script>
	document.cookie = "sw="+window.innerWidth;
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="container-fluid">
	<div class="row">
		
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
			<div>
				<a href="/topBar/en" class="textwidth btn btn-primary btn-block">En</a>
				<a href="/topBar/pl" class="textwidth btn btn-primary btn-block">Pl</a>
				<a href="/topBar/uk" class="textwidth btn btn-primary btn-block">Укр</a>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class='col-lg-6 col-md-6 col-sm-10 col-xs-12'>	
			<h2 class="text-center">Simple Top Bar</h2>
			<ul class="nav nav-tabs" style="margin-left: 0;">
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
				<div id="myTab" class="tab-pane fade in active" style="margin-top:20px ;">
					<p><?php echo $this->Translate('Simple Top Bar is a simple but powerful tool that will make your site more stylish and user-friendly! This innovative element allows you to create an elegant top bar that will impress your visitors and make their stay on your site unforgettable.')?></p>
					<p><?php echo $this->Translate("With Simple Top Bar, you can easily display important information such as promotions, offers or the most important message so that your visitors don't miss any important event.")?></p>
					<p><?php echo $this->Translate('This tool allows you to customize the colors, fonts and placement to perfectly fit your design.')?></p>
					<p><?php echo $this->Translate('Thanks to the Simple Top Bar, you will be able to attract attention immediately after users enter your site. It is easy to use, but adds professionalism and elegance to your site.')?></p>
					<p><?php echo $this->Translate("Don't waste time, install Simple Top Bar today and make your site more attractive to your visitors! Impress them at first sight with this simple yet powerful tool to create a great top line!")?></p>
					<p><?php echo $this->Translate('author')?> <a target="_blank" href="https://profiles.wordpress.org/sl147"><?php echo $this->Translate('Yaroslav Livchak')?></a> </p>
				</div>
				<div id="opinian" class="tab-pane fade">
					<? if (empty($comment)) :?>
						<div class="text-center">
							<h4><?php echo $this->Translate('There are no reviews')?></h4>
						</div>
					<? else :?>
						<h5 class="text-center"><?php echo $this->Translate('Reviews')?> <?= count($comment)?></h5>
						<?php foreach ($comment as $item) :?>
							<p class='text-left ip_Comment'><?=$item['nik'] ?> : <?=$item['text'] ?></p>
							<br>
						<?php endforeach; ?>	
					<? endif; ?>
					<form id = "formCom" method="POST">
						<fieldset>
							<legend class="text-center"><?php echo $this->Translate('Add a comment')?>:</legend>
							<label style="width: 80px;" class="text-left"><?php echo $this->Translate('Name')?>:</label>
							<input style="width: 200px;" name="nik_com" type="text"><br><br>

							<label style="width: 80px;" class="text-left"><?php echo $this->Translate('e-mail')?>:</label>
							<input style="width: 200px;" name="email_com" type="email" /><span style="margin-left: 20px;"><?php echo $this->Translate('is not displayed in reviews')?></span><br><br>

							<label style="width: 130px;" class="text-left"><?php echo $this->Translate('Comment')?>:</label>
							<textarea style="width: 100%;margin-bottom:20px;" name = "txt_com" rows ='3' maxlength="2000"></textarea>
							<input id="check" name="check" type="hidden" value="" />
							<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block"><?php echo $this->Translate('Submit')?></button></div>
						</fieldset>
					</form><br>	
				</div>
				<div id="instalation" class="tab-pane fade">
					<p style="text-indent: 20px;margin-top:20px ;">
						<?php echo $this->Translate("Upload the plugin to your page. Activate it and set settings only.")?> 
					</p>
				</div>
			</div>	
		</div>
	</div>
</div>

<script src="/js/jquery-1.11.3.min.js"></script>
<!-- <script src="/libs/jquery/jquery-1.11.3.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>