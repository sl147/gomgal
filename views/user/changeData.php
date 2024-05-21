<form role="form" id = "auth4" method="POST">
	<fieldset>
		<legend><b>Редагування даних</b></legend>

		<label >Логін</label><?=$userCurrent['user_login']?><br><br>

		<label>Ім'я</label><input class="authorRow" name="name" type="text" value="<?=$userCurrent['name']?>"><br><br>

		<label>Прізвище</label><input class="authorRow" name="surname" type="text" value="<?=$userCurrent['surname']?>"><br><br>

		<label>E-mail</label><input class="authorRow" name="email" type="email" value="<?=$userCurrent['email']?>"><br><br>
		<input name="_token" type="hidden" value="<?= $token?>">
		<div class="text-center">
			<button name="submit" type="submit" class="btn btn-success">Змінити</button>
		</div>
	</fieldset>
</form>