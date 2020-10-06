<?php include 'views/layouts/header.php';?>

  <form method="post">
   введіть назву фотоальбому<input autofocus type="text" name="name_FA" size="78"><br><br>
   опишіть свій фотоальбом<br><textarea name = "msgs_FA" rows ='7' cols = '78'></textarea><br>
   <input type="submit" name="submit" value="Створити">
  </form>

<?php include 'views/layouts/footer.php';?>