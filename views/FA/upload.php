<?php include 'views/layouts/headerAdmin.php';?>
<div class="row">
 <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h3 class='text-center'>
	Завантаження фотографій до фотоальбому
</h3>
</div>
</div>

<div class="row">
 <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<form enctype="multipart/form-data" method="post"> 
    <div class="Fadiv">
     <label class="FAlabel" for="photo">
       Виберіть фотографію з Вашого комп'ютера
     </label>	
	<input type="file" name="photo" multiple accept="image/*,image/jpeg">
</div>
<div class="Fadiv">
	<label class="FAlabel" for="subscribe">
       Підпис до фото
     </label>
	
	<input type="text" name="subscribe" size="60" placeholder=""><br><br>
   </div>
   <div class="text-center">
    <button type='submit' title='додати запис' name="submit" class='btn btn-info Fabtn'>
      Створити
    </button>
  </div>
</form>
</div>
</div>

<?php include 'views/layouts/footerAdmin.php';?>

<style>
  .FAlabel{
    margin-right: 10px ;
    width: 20rem;
  }
  .Fadiv {
    display: flex;
    align-items: center;
  }
  .Fabtn{
    margin-top: 15px;
  }
</style>