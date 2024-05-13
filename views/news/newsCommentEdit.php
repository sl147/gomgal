<?php include 'views/layouts/headerAdmin.php';?>	
<div class="row" style="margin: 0 20px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h2 class="text-center"><?= $title?></h2>
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">ID</th>
					<th class="text-center">ID статті</th>
					<th class="text-center">коментар</th>
					<th class="text-center">автор</th>
					<th class="text-center">e-mail</th>
					<th class="text-center">IP</th>
					<th class="text-center">стан</th>
					<th></th>
				</tr>					
			</thead>
			<tbody>
				<?php foreach ($comms as $item) :?>
					<tr>
						<td class="text-center"><?=$item['id_com']?></td>
						<td class="text-center"><?=$item['id_cl']?></td>
						<td class="text-center"><?=$item['txt_com']?></td>
						<td class="text-center"><?=$item['nik_com']?></td>
						<td class="text-center"><?=$item['email_com']?></td>
						<td class="text-left">  <?=$item['ip_com']?></td>
						<td class="text-center">
							<form method="post">
							   <input type="hidden" name="active" value="<?=$item['active']?>">
							   <input type="hidden" name="id_change" value="<?=$item['id_com']?>">
							   <button type='submit' name="submit" title="видалити запис" class="btn <?=  ($item['active']) ? 'btn-default' : 'btn-danger' ?>" >
								<?= ($item['active']) ? 'активний' : 'не активний'?>
								</button>
							 </form>
						</td>
						<td>
							<form method="post">
							   <input type="hidden" name="id" value="<?=$item['id_com']?>">
							   <button type='submit' name="submit" title='видалити запис' class='btn btn-default btn-lg'>
								<i class="fa fa-trash fa-fw"></i>
								</button>
							 </form>
						</td>	
					</tr>
				<?php endforeach; ?>					
			</tbody>
		</table>
	</div>
</div>
<div class="text-center"><? echo $pagination->get(); ?></div>
<?php include 'views/layouts/footerAdmin.php';?>