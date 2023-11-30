<?php include 'views/layouts/headerAdmin.php';?>

<h2 class="text-center">
	Активуєм голосування
</h2>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">			
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
			<tr class='success'>
				<th class="text-center">найменування</th>
				<th class="text-center">дія</th>
				<th class="text-center">стан</th>
			</tr>					
		</thead>
		<tbody>
			<?php foreach ($allVotes as $vote) :?>
				<tr>
					<td class="text-center authorRow">
						<?=$vote['title']?>
					</td>
					<td class="text-center authorRow">
						<form method = 'POST'>
							<button name="submit" type="submit" class="btn-block btn btn-primary"> Активувати</button>
							<input style='visibility: hidden;' type='text' name='id' value='<?=$vote['id']?>'>
						</form>
					</td>						
					<td>
						<?php if ($vote['active']) :?>
							<div class="text-center">
								<b style="color: red">
									активне
								</b>
							</div>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>				
	</table>
</div>

<?php include 'views/layouts/footerAdmin.php';?>