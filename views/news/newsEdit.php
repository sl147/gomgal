<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">
	<h2 class="text-center">
		<?= $title?>	
	</h2>
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">ID</th>
						<th class="text-center">найменування</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<tr v-for="elm in elements">
						<td class="text-center">
							{{elm.id}}
						</td>
						<td class="text-left">
							{{elm.title}}
						</td>
						<td>
							<div class="text-center">
								<a class="btn btn-default btn-lg" :href="/newsEditOne/+elm.id+'/'+elm.page" title="редагувати запис">
									<i class="fa fa-edit fa-fw"></i>
								</a>
							</div>
						</td>
						<td>
							<div class="text-center">
								<button @click="del2el(elm)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
									<i class="fa fa-trash fa-fw"></i>
								</button>
							</div>
						</td>	
					</tr>					
				</tbody>
			</table>
		</div>
	</div>			
</div>

<div class="text-center">
	<? echo $pagination->get(); ?>
</div>

<?php include 'views/layouts/footerAdmin.php';?>

<script>
	window.table=<?= $json ?>;
</script>

<script src="/js/vue/newsEdit.js"></script>