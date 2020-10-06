<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">	
	<div class="row">
		<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
			<h2 class="text-center">
				<?= $title?>
			</h2>
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">ID</th>
						<th class="text-center">ID статті</th>
						<th class="text-center">коментар</th>
						<th class="text-center">автор</th>
						<th class="text-center">e-mail</th>
						<th class="text-center">IP</th>
						<th></th>
					</tr>					
				</thead>
				<tbody v-for="elm in elements">
					<tr>
						<td class="text-center">{{elm.id}}</td>
						<td class="text-center">{{elm.id_cl}}</td>
						<td class="text-center">{{elm.txt_com}}</td>
						<td class="text-center">{{elm.nik_com}}</td>
						<td class="text-center">{{elm.email_com}}</td>
						<td class="text-left">{{elm.ip_com}}</td>
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
<script src="/js/vue/newsCommentEdit.js"></script>