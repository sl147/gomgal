<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h2 class="text-center">
				<?= $title?>
			</h2>			
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
						<td class="text-center">
							{{elm.title_p}}
						</td>
						<td>
							<a class="btn btn-block btn-default btn-lg" :href="/posterEditOne/+elm.id+'/'+elm.page" title="редагувати запис">
								<i class="fa fa-edit fa-fw"></i>
							</a> 
						</td>
						<td>
							<button @click="del2el(elm)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
								<i class="fa fa-trash fa-fw"></i>
							</button>
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
<script src="/js/vue/posterEdit.js"></script>