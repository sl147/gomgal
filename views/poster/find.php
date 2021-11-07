<?php include 'views/poster/menuPoster.php';?>
<form method='POST'>
	<br><input type="text" style="width: 100%;" name="name_f" placeholder="Введіть текст для пошуку"><br><br>
	<input name="_token" type="hidden" value="<?= $token?>">
	<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
	 	Знайти
	</button>
</form>