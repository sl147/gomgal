<?php include 'views/layouts/headerAdmin.php';?>
<div class="row">
 <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <h2 class="text-center">
    Створення фотоальбому 
  </h2>
</div>
</div>
<div class="row">
 <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
   <form method="post">
    <div class="Fadiv">
      <label class="FAlabel" for="name_FA">
        введіть назву фотоальбому
      </label>
      <input autofocus type="text" name="name_FA" size="75">
    </div><br><br>
    <div class="Fadiv">
     <label class="FAlabel" for="msgs_FA">
       опишіть свій фотоальбом
     </label>
     <textarea name = "msgs_FA" rows ='7' cols = '78'></textarea><br>
   </div>
   <div class="text-center">
    <button type='submit' title='додати запис' name="submit" class='btn btn-info Fabtn'>
      Створити
    </button>
  </div>

  <!--  <input type="submit" name="submit" value="Створити"> -->
</form>
</div>
</div>


<?php include 'views/layouts/footerAdmin.php';?>
<style>
  .FAlabel{
    margin-right: 10px ;
    width: 15rem;
  }
  .Fadiv {
    display: flex;
    align-items: center;
  }
  .Fabtn{
    margin-top: 15px;
  }
</style>