<<<<<<< HEAD
<?php include 'views/poster/menuPoster.php';?>
<form method='POST'>
	<div style="color: grey;">Введіть текст для пошуку</div>
	<br><input type="text" style="width: 100%;" name="name_f"><br><br>
	<input name="_token" type="hidden" value="<?= $token?>">
	<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
	 	Знайти
	</button>
=======
<?php include 'views/poster/menuPoster.php';?>
<form method='POST'>
	<br><input type="text" style="width: 100%;" name="name_f" placeholder="Введіть текст для пошуку"><br><br>
	<input name="_token" type="hidden" value="<?= $token?>">
	<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
	 	Знайти
	</button>
>>>>>>> 794f6b20b741bd6353fe7f9c1ad5df9082cad23e
</form>