<?php include 'views/layouts/headerAdmin.php';?>
<h2 class='text-center'>Користувачі</h2>
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
<table class='table table-responsive table-bordered table-striped table-hover'> 
	<thead>
		<tr class='success' style='color: grey; font-size:12px; font-weight:bold;'>
			<th class="text-center">логін</th>
			<th class="text-center">ім'я</th>
			<th class="text-center">прізвище</th>
			<th class="text-center">e-mail</th>
			<th class="text-center">роль</th>
		</tr>
	</thead>
	<tbody>
	<?php $j=1; foreach ($users as $item) :?>
		<tr>
		<td><?=$item["user_login"]?></td>
		<td><?=$item["name"]?></td>
		<td><?=$item["surname"]?></td>
		<td><?=$item["email"]?></td>
		<td><? echo ($item["admin"]) ? 'адміністратор' : 'користувач'?></td>
		</tr>
		<?php $j++; if( ($j == 10) || ($j == 25) ) :?>
			<tr >
				<td colspan="7"><?=Auxiliary::getAdSence()?></td>
			</tr>
		<?php endif;?>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>