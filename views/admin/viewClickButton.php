<?php include 'views/layouts/headerAdmin.php';?>
<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<h2 class="text-center">
			Переходи по кнопкам
		</h2>
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class = "success">
					<th class="text-center">id</th>
					<th class="text-center">найменування</th>
					<th class="text-center">кількість</th>						
				</tr>
			</thead>
			<tbody>
				<? $all = 0;?>
				<?php foreach ($countButton as $item) :?>
					<? $all += $item['count'];?>
					<tr class="text-center">
						<td>
							<?=$item['id']?>
						</td>
						<td>
							<?=$item['name']?>
						</td>
						<td>
							<?=$item['count']?>
						</td>
					</tr>
               <?php endforeach ?>
				<tr class="text-center">
					<td></td>
					<td class="text-center">всього</td>
					<td><?=$all?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>