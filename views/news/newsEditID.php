<?php include 'views/layouts/headerAdmin.php';?>

<h2 class="text-center">
	редагування новини за ID
</h2>
<form method="POST" class="text-center">
	<input style='font-size: 12px;' size='40' name='id' type='number' placeholder='введіть ID новини' autofocus>
	<button name="submit" type="submit" class="btn btn-info btn-lg">
		шукати
	</button>
</form>
<?php include 'views/layouts/footerAdmin.php';?>