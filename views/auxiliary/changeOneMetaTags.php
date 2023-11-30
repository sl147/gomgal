<?php include 'views/layouts/headerAdmin.php';?>
<h2 class="text-center">Редагування метатегів для url <?= $MTOne['url_name']?></h2>
<div class="row-fluid">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
	<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
        <form method="POST">
         <h4>url: <br><input style='width: 300px;' type = "text" name="url_name" autofocus value="<?= $MTOne['url_name']?>"><br><br>
         title : <br><textarea wrap="soft" cols="80" rows="3" type = "text" name="title"><?= $MTOne['title']?></textarea><br><br>
         description : <br><textarea wrap="soft" cols="80" rows="5" type = "text" name="descr"><?= $MTOne['descr']?></textarea><br><br>
         keywords : <br><textarea wrap="soft" cols="80" rows="3" type = "text" name="keywords"><?= $MTOne['keywords']?></textarea><br><br>
         follow : <br><textarea wrap="soft" cols="80" rows="3" type = "text" name="follow"><?= $MTOne['follow']?></textarea><br><br>
         </h4>
         <div class="text-center"><button name="submit" type="submit" class='btn btn-info'>Змінити</button></div>
       </form>
	</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>