<?php include 'views/layouts/headerAdmin.php';?>
<script src="/ckeditor/ckeditor.js"></script>
<h2 class="text-center">
	<?= $title?>
</h2>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<form id='forPoster' enctype="multipart/form-data" method = "post">
			<label>заголовок:</label>
			<input size="90" name = 'title_p' value="<?= $post['title_p']?>"><br><br>

			<label>категорія:</label>
			<select name = 'category' title='виберіть категорію'>
				<?foreach ($posterCat as $catPost) {
					echo "<option value = '".$catPost['id_cat']."'>".$catPost['cat_cat']."</option>";
				}
				?>	
			</select><br><br>
			<label>тип:</label>
			<select name = 'type' title='виберіть тип'>
				<?	
				for ($j = 0; $j < count($typePost); $j++) {
					echo"<option value = '".$j."'>".$typePost[$j]."</option>";
				}
				?>	
			</select><br><br>
			
			<?if ($post["impot"] == 1) :?>
				<label>важливе: </label>
				<input name="impot" type="checkbox" class='cBox' checked>
			<?else :?>
				<label>важливе: </label>
				<input name="impot" type="checkbox" class='cBox' >
			<?endif;?>
			<br><br>
			<label>подав:</label><input size="90" type="text" name="name" value="<?= $post['name_p']?>"><br><br>
			<label>email: </label><input type="text" name="email" value="<?= $post['email_p']?>"><br><br>
			<label>текст оголошення: </label><br><br><br>
			<textarea name = 'msg' rows ='6' cols = '100' maxlength='800'><?= $post['msg_p']?></textarea><br>

			<?if ($post["fotoN"]) :?>
				<div style="height: 140px;">
					<div style="float: left;">
						<!-- <a title='<?= $post["title_p"]?>' href='<?= $post["foto_p1"]?>'> -->
							<img height="120" alt='<?= $post["title_p"]?>' src='<?= $post["foto_p1"]?>'>
						<!-- </a> -->
					</div>
					<div style='float: left;padding-left: 90px;'>
						<input type="checkbox" name="FotoDel" /> Видалити фото<br><br>
					</div>
				</div><br><br>
			<?endif;?>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			<label>фото оголошення: </label><br>
				<input name="file" type="file"  />
			<input type="hidden" name="id_m" value="<?= $post["id_poster"]?>" />
			<button name="submit" type="submit" class="btn-block btn btn-info btn-lg"> Змінити </button>
		</form>
	</div>			
</div>			
<?php include 'views/layouts/footerAdmin.php';?>
<script type='text/javascript'>
	CKEDITOR.replace('msg');
</script>