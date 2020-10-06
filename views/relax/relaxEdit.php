<?php include 'views/layouts/headerAdmin.php';?>	
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
		<h2 class="text-center">
			<?= $title?>			
		</h2>
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">ID</th>
					<th class="text-center"></th>
					<th></th>
					<th></th>
				</tr>					
			</thead>
			<tbody>
				<?php foreach ($comms as $item) :?>
					<tr>
						<td class="text-center">
							<?=$item['id']?>
						</td>
						<td class="text-left">
							<?=$item['msg']?>
						</td>
						<td>
							<a href="/relaxEditOne/<?= $item['id']?>" type='button' title='редагувати запис' class='btn btn-primary btn-block btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</a>
						</td>
						<td>
							<!-- <button type='button' title='видалити запис' class='btn btn-primary btn-block btn-lg'> -->
								<form method="POST">
									<input style='visibility: hidden;' type='text' name='id' value='<?=$item['id']?>'>
							<button name="submit" type="submit" title='видалити запис' class='btn btn-primary btn-block btn-lg'>
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
<?php if ($total > SHOWCOMMENT_BY_DEFAULT) :?>
	<div class="text-center">
		<? echo $pagination->get(); ?>
	</div>
<?php endif; ?>
<?php include 'views/layouts/footerAdmin.php';?>