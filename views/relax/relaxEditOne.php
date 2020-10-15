<?php include 'views/layouts/headerAdmin.php';?>
<script src="/ckeditor/ckeditor.js"></script>
<h2 class="text-center"><?= $title?></h2>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<?php if($comms) :?>
		<form method='POST' id = "auth1">
			<label>категорія:</label>
			<select id = 'cat' name = 'category'>
		    <?
			    $r = new Relax();
			    array_unshift($tPos, []);
				$tPos[0]['id'] = $comms['category'];
				$tPos[0]['name']    = $r->getRelaxId($comms['category'])['namerl'];
			    foreach ($tPos as $pos) {
			    	echo"<option value = '".$pos['id']."'>".$pos['name']."</option>";
			    }
			    unset($r);
			?>
		    </select><br><br>

			<label>Текст новини:</label><br><br>
			<textarea class="txtArWidth" name = "msg" rows ='8'  maxlength="3000" required>
				<?= $comms['msg']?>
			</textarea><br><br>

			<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
				Змінити
			</button>			
		</form>
		<?php else :?>
			<h2 class="text-center"> намає новин з таким id <?= $id?></h2>
		<?php endif ;?>
	</div>			
</div>		
<?php include 'views/layouts/footerAdmin.php';?>
<script type='text/javascript'>
	CKEDITOR.replace('msg');
</script>