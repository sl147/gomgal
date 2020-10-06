<form role="form" id = "auth" method="POST">
	<fieldset>
		<legend style="font-size: 12px;">
			<b>Реєстрація</b>  (поля відмічені <b style='color: red;'>червоним </b>обов'язкові до заповнення)
		</legend>

		<label style='color:red'><b>Логін</label>
			<input  autofocus id="login" name="login" type="text" class="authorRow"><br><br>
		<label style='color:red'>Пароль</label>
			<input id="password" name="password" type="password" class="authorRow"><br><br>

		<label style='color:red'>Повторіть пароль</label>
			<input id="passwordConfirm" name="passwordConfirm" type="password" class="authorRow"><br><br>
		<label style='color:red'>Ім'я</label></b>
			<input id="name" name="name" type="text" class="authorRow"><br><br>

		<label>Прізвище</label>
			<input name="surname" type="text" class="authorRow"><br><br>

		<label>E-mail</label>
			<input name="email" type="email" placeholder="E-mail" class="authorRow"><br><br>

		<div class="text-center">
			<button name="submit" type="submit" class="btn btn-success">Зареєструвати</button>
		</div>
	</fieldset>
</form>