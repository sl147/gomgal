<?php include 'views/layouts/headerAdmin.php';?>
<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<h2 class="text-center">перегляд коментарів</h2>
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center">id</th>
				<th class="text-center">тип</th>
				<th class="text-center">текст</th>
				<th class="text-center">нік</th>
				<th class="text-center">ІР</th>
				<th class="text-center">актив/неактив</th>
				<th></th>
			</tr>					
		</thead>
		<tbody>
			<?php foreach ($comments as $comment) :?>
				<tr>
					<td class="text-center">
						<?=$comment['id']?>
					</td>
					<td class="text-center">
						<?=$comment['name']?>
					</td>
					<td class="text-left" style='width: 400px;'>
						<?=$comment['text']?>
					</td>
					<td class="text-center">
						<?=$comment['nik']?>
					</td>
					<td class="text-center">
						<?=$comment['ip']?>
					</td>
					<?php if ($comment['active']) :?>
						<td class="text-center">активне</td>
						<td class="text-center">
							<form method = 'POST'>
								<input type='hidden' name='id' value='<?=$comment['id']?>'>
								<input type="hidden" name="active" value="0">
								<button name='submit' class="btn btn-info">відмінити</button>
							</form>
						</td>
						<?php else :?>
							<td class="text-center">не активне</td>
							<td class="text-center">
								<form method = 'POST'>
									<input type='hidden' name='id' value='<?=$comment['id']?>'>
									<input type="hidden" name="active" value="1">
									<button name='submit' class="btn btn-info">активувати</button>
								</form>
							</td>
						<?php endif; ?>

					</tr>
				<?php endforeach; ?>					
			</tbody>				
		</table>
		<?php if ($total > SHOWCOMMENT_BY_DEFAULT) :?>
			<div class="text-center"><? echo $pagination->get(); ?></div>
		<?php endif; ?>	
	</div>
<?php include 'views/layouts/footerAdmin.php';?>