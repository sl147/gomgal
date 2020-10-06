<?php include 'views/poster/menuPoster.php';?>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
<div class="col-lg-10 col-md-10 col-sm-2 col-xs-2">
	<h2 class="text-center" style='color:red'>Додати оголошення</h2>
	<form method='POST' id = "auth2" enctype="multipart/form-data">	      	
		<label> Ім'я (хто подає оголошення): </label>
		<input class="textWidth" size="78" type = "text" name = "nik" autofocus required /><br><br>
		<label>Виберіть тип і категорію оголошення:</label><br><br>
		<select name = 'type' required>
			<?php for ($j = 0; $j <= $count; $j++) :?>
				<option value = "<?=$j?>"><?=$tPos[$j]?></option>";
			<?php endfor ;?>										
		</select>
		<select name = "category">
			<?php foreach ($catList as $item) :?>
				<option value = "<?=$item['id']?>"><?=$item['cat_cat']?></option>";
			<?php endforeach; ?>
		</select><br><br>				
		<label>E-mail:</label>
		<input type = "email" class="form-control" name = "email" size="78" /><br>
		<label>Заголовок:</label>
		<input class="textWidth" type = "text" size="78" id = "title" name = "title" required /><br><br>
		<label>Текст оголошення:</label>
		<textarea name = "msg" rows ='9' class="textWidth" maxlength='2000' required></textarea><br><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="300000000">
		<label>Додати фотографію</label>
		<input type="file" name="file" multiple accept="image/*">
		<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
			Додати
		</button>
	</form>
</div>