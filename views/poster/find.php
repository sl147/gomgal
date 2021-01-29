<?php include 'views/poster/menuPoster.php';?>
<form method='POST'>
	<div style="color: grey;">Введіть текст для пошуку</div>
	<br><input type="text" style="width: 100%;" name="name_f"><br><br>
	<input name="_token" type="hidden" value="<?= $token?>">
	<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
	 	Знайти
	</button>
</form>