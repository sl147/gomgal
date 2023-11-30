<?php include 'views/layouts/headerAdmin.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<h2 class="text-center" style='color:red'>
	Додати новину
</h2>
<form method='POST' id = "auth1" enctype="multipart/form-data">
	<label>Заголовок новини:</label>
		<textarea maxlength="100" type="text" name="title" rows='2' cols='95' required></textarea><br><br>
	<label>Preview новини:</label>
		<textarea type = "text" name = "prew" rows ='2' cols = '95' maxlength="200" required></textarea><br><br>
    <label>Топ новина</label>
    	<input class="checkboxTop" name="top" type="checkbox"><br><br>
	<label>категорія:</label>
		<select id = 'cat' name = 'category' required>
	    <?
		    for ($j = 0; $j <= count($tPos); $j++) {
			echo"<option value = '".$tPos[$j]['id']."'>".$tPos[$j]['name']."</option>";
			}
		?>
	    </select><br><br>
	<label>категорія ще:</label>
		<select id = 'cat' name = 'category2' required>
		<?
		    for ($j = 0; $j <= count($tPos); $j++) {
			echo"<option value = '".$tPos[$j]['id']."'>".$tPos[$j]['name']."</option>";
		}
		?>
		</select><br><br>

	<label>Текст новини:</label><br><br>
		<textarea name = "msg" rows ='8' cols = '70' maxlength="3000" required></textarea><br>
	<label>Джерело:</label>
		<input type = "text" name = "sourse" required /><br><br>
	<label>Пароль YouTube</label>
		<input  name="videoYT" type="text"><br><br>
    	<input type="hidden" name="MAX_FILE_SIZE" value="3000000">		  
    <label>Додати фотографію</label>
    	<input type="file" id="photo" name="file"  accept="image/*,image/jpeg"><br><br>
    <button name="submit" type="submit" class="btn-block btn btn-info btn-lg"> Додати новину</button>
</form>
<?php include 'views/layouts/footerAdmin.php';?>
<script type='text/javascript'>
	CKEDITOR.replace('msg');
</script>