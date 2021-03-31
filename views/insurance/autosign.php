<script>
	document.cookie = "sw="+window.innerWidth;
</script>
<?php include 'views/Insurance/headerInsurance.php';?>
	<div id="sign">
		<!-- <img src="../image/1.jpg" class="bgFull"> -->
		<div class="str-main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
					<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0">
						<?php include 'views/insurance/insLeftSide.php';?>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
					<div class='auth col-lg-4 col-md-4 col-sm-10 col-xs-12'>		

						<h3 class="text-center var">АВТО НОМЕРА УКРАЇНИ</h3>
						<span>Область</span><br>
						<select v-model="regionName">
							<option v-for="name in single_option" v-bind:value="name">
								{{ name }} 
							</option>
						</select><br><br>

						<span>код регіону</span><br>
						<select v-model="regionKod">
							<option v-for="option in symbols" v-bind:value="option">
								{{ option }}
							</option>							
						</select><br><br>

						<div class="text-center var"> {{ regView }}</div> 
						<div class="text-center var"> {{ nameView }}</div> 

					</div>
					<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
					<div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
						<!-- <?php include ("views/insurance/InsuranceComments.php")?> -->
						<form id = "formCom" method="POST">
							<fieldset>
								<legend class="text-center">Додати коментар</legend>
								<label class="text-center">Ім'я</label>
								<input name="nik_com" type="text"><br><br>
								<label class="text-center">Коментар</label>
								<textarea align='center' name = "txt_com" rows ='3' maxlength="2000"></textarea>
								<input id="check" name="check" type="hidden" value="" />
								<div class="text-center"><button name="submit" type="submit" class="btn btn-info btn-block">додати</button></div>
							</fieldset>
						</form><br>

						<? if (empty($comment)) :?>
							<div class="text-center">
						    <h4>Коментарів немає</h4>
						    </div>
						<? else :?>

						<h5 class="text-center">Коментарів <?= count($comment)?></h5>
						    <?php foreach ($comment as $item) :?>
						    	
						        <p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
						        <p class="news_Comment"><?=$item['text'] ?></p>
						        <br>
						    <?php endforeach; ?>	
						<? endif; ?>						
					</div>					
				</div>
			</div>
		</div>
	</div>

<script src="/js/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/lodash.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue/autosign.js"></script>	