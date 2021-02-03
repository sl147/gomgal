<?php include 'views/layouts/headerAdmin.php';?>
<script src="/ckeditor1/ckeditor.js"></script>
<!-- <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->
<!-- <script src="/ckeditor5-build-classic/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script> -->
<h2 class="text-center"><?= $title?></h2>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<?php if($isId) :?>
		<form method='POST' id = "auth1" enctype="multipart/form-data">
			<label>Заголовок новини:</label><br><br>
			<textarea class="txtArWidth" maxlength="100" type="text" name="title" rows='2' required><?= $allNews['title']?></textarea><br><br>
			<label>Preview новини:</label>
			<textarea class="txtArWidth" type = "text" name = "prew" rows ='2' maxlength="200" required><?= $allNews['prew']?></textarea><br><br>
			<?if ($allNews["top"] == '1') :?>
				<label>Топ новина: </label>
				<input name="top" type="checkbox" class='cBox' checked>
			<?else :?>
				<label>Топ новина: </label>
				<input name="top" type="checkbox" class='cBox'>
			<?endif;?><br><br>
			<label>категорія:</label>
			<select id = 'cat' name = 'category'>
		    <?
			    foreach ($tPos as $pos) {
			    	echo"<option value = '".$pos['id']."'>".$pos['name']."</option>";
			    }
			?>
		    </select><br><br>
			<label>категорія ще:</label>
			<select id = 'cat' name = 'category2'>
			<?
				foreach ($tPos2 as $pos) {
			    	echo"<option value = '".$pos['id']."'>".$pos['name']."</option>";
			    }
			?>
			</select><br><br>
			<label>Текст новини:</label><br><br>			
			<textarea class="txtArWidth" name = "msg" rows ='8' required>
				<?= $allNews['msg']?>
			</textarea><br><br>
			<label>Джерело:</label>
				<input type = "text" name = "sourse" value="<?= $allNews['sourse']?>" required/><br><br>
			<label>Пароль YouTube</label>
			<input  name="videoYT" type="text" value="<?= $allNews['videoYT']?>"><br><br>
			<?if ($allNews["foto"]) :?>
				<div style="height: 140px;">
					<div style="float: left;">
						<img height="120" alt="<?= $allNews['title']?>" src="<?= $allNews['photo']?>">
					</div>
					<div style='float: left;padding-left: 90px;'>
						<input type="checkbox" name="FotoDel" /> Видалити фото<br><br>
					</div>
				</div><br><br>
			<?endif;?>			
	    	<input type="hidden" name="MAX_FILE_SIZE" value="3000000">		  
		    <label>Додати фотографію</label>
		    	<input type="file" id="photo" name="file"  accept="image/*,image/jpeg"><br><br>
			<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
				Змінити новину
			</button>			
		</form>
		<?php else :?>
			<h2 class="text-center"> намає новин з таким id</h2>
		<?php endif ;?>
	</div>			
</div>		
<?php include 'views/layouts/footerAdmin.php';?>
<script type='text/javascript'>
	CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
};
	CKEDITOR.replace('msg');
</script>
<!-- <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script> -->

<!--     <script type="text/javascript">
    	DecoupledEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        const toolbarContainer = document.querySelector( '#toolbar-container' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
    } )
    .catch( error => {
        console.error( error );
    } );
    </script> -->
<!--     <script>
function test()
{
$("editor").value += "123\r\n";
}
</script> -->