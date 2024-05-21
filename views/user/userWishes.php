<?php include 'views/layouts/headerAdmin.php';?>
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
		<h2 class="text-center"><?= $title?></h2>
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">ID</th>
					<th class="text-center">автор</th>
					<th class="text-center">e-mail</th>
					<th class="text-center">IP</th>
					<th class="text-center">побажання</th>
			</thead>
			<tbody>
				<?php foreach ($comms as $item) :?>
					<tr>
						<td class="text-center"><?=$item['id_com']?></td>
						<td class="text-left"><?=$item['nik_com']?></td>
						<td class="text-center"><?=$item['email_com']?></td>
						<td class="text-left"><?=$item['ip_com']?></td>
						<td class="text-left"><?=$item['txt_com']?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php if ($total > SHOWCOMMENT_BY_DEFAULT) :?>
	<div class="text-center">
		<? echo $pagination->get(); ?>
	</div>
<?php endif; ?>
<?php include 'views/layouts/footerAdmin.php';?>