<?php include 'views/relax/headerRelax.php';?>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
<div class="col-lg-10 col-md-10 col-sm-2 col-xs-2">
	<h4 class="text-center">
		Додати анекдот
	</h4>			
	<form id = "auth" method = "post">
		<label style='color:red'>Виберіть тему анекдоту: </label>
		<select class='selectcl' name = 'teman' required>";
			<?php foreach ($teman as $item) :?>
				<option value = "<?=$item['id']?>"><?=$item['name']?></option>
			<?php endforeach ;?>
		</select><br><br>	      	
		<label>Текст анекдоту:</label>
		<textarea class="textWidth" name = "msg" rows ='19'></textarea><br>
		<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
			Додати анекдот
		</button>
	</form>			
</div>

<!-- <? if ($show) :?>
  <div class="showAlertAn">
    <div class="alert alert-info alert-dismissible" role="alert">
    	Дякуєм. Ваш анекдот додано
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        &times;
      
    </div>
  </div>
<?endif;?> -->

<!-- <script>
 $(document).ready(function(){
setTimeout(function () { $('.showAlertAn').removeClass() }, 2000);
// $('.showAlertAn').css('visibility','hidden');
 });
</script> -->
