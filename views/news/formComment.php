<form role="form" id = "auth3" method="POST">
	<fieldset>
		<legend class="text-center">
			Додати коментар
		</legend>
		<div class="form-group">
			<label>Ім'я</label>
			<input name="nik_com" type="text"><br>
		</div>
		<div class="form-group">
			<label>E-mail<br>(не обов'язково)</label>
			<input name="email_com" type="email"><br>
		</div>
		<div class="form-group">
			<p>Коментар</p>
			<textarea id="comm" name = "txt_com" rows ='7' style="width: 100%;" maxlength="2000">
			</textarea>
		</div>
		<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
			Відправити
		</button>
	</fieldset>
</form>