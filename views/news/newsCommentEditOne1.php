<?php include 'views/layouts/headerAdmin.php';?>
<script src="/ckeditor/ckeditor.js"></script>
<h2 class="text-center"><?= $title?></h2>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<form method='POST' id = "auth1" enctype="multipart/form-data">
			<label>Ім'я:</label>
			<input type = "text" name = "nik" value="<?= $allNews['nik_com']?>"/><br><br>
			<label>email:</label>
			<input type = "text" name = "email" value="<?= $allNews['email_com']?>"/><br><br>
			Текст коментаря:<br><br>
			<textarea type="text" name="txt" rows='10' cols='95'>
				<?= $allNews['txt_com']?>
			</textarea><br><br>
			<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
				Змінити коментар
			</button>			
		</form>
	</div>			
</div>		
<?php include 'views/layouts/footerAdmin.php';?>
<script type='text/javascript'>
	CKEDITOR.replace('txt');
</script>