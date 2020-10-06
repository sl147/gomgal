<?php include 'views/layouts/header.php';?>
<h3 class='text-center'>
	Загрузка фотографій
</h3>		  
<form enctype="multipart/form-data" method="post">       
	Виберіть фотографію з Вашого комп'ютера
	<input type="file" name="photo" multiple accept="image/*,image/jpeg"><br><br>
	Підпис до фото
	<input type="text" name="subscribe" size="60" placeholder=""><br><br>
	<input type="submit" name="submit" value="Відправити">
</form>

<?php include 'views/layouts/footer.php';?>