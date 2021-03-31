<?php include 'views/layouts/headerAdmin.php';?>
<div class="container-fluid">
	<div class="row">				
		<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
			<br><br>
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">id</th>
						<th class="text-center">код країни</th>
						<th class="text-center">місто</th>
						<th class="text-center">екран</th>
						<th class="text-center">з сайту</th>
						<th class="text-center">к-ть</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user) :?>
						<tr>
							<td class="text-center"><?=$user['id']?></td>
							<td class="text-center"><?=$user['country_code']?></td>
							<td class="text-center"><?=$user['city']?></td>
							<td class="text-center"><?=$user['width']?></td>
							<td class="text-center"><?=$user['htpreferer']?></td>
							<td class="text-center"><?=$user['count']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>				
			</table>
		</div>
	</div>
</div>