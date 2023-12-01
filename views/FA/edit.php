<?php include 'views/layouts/headerAdmin.php';?>
<div id='edit'>
	<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<table class="table table-responsive table-bordered table-striped table-hover">
		<thead>
				<tr class='success'>
					<th class="text-center">ID</th>
					<th class="text-center">Назва фотоальбому</th>
					<th class="text-center">Опис фотоальбому</th>
					<th></th>
					<th></th>
				</tr>					
			</thead>
	<tbody v-for="item in albums">
		<td>{{item.id_FA}}</td>
		<td>{{item.name_FA}}</td>
		<td>{{item.msgs_FA}}</td>
		<td>
			<a v-bind:href="/faEditOne/+item.id" title='редагувати запис' class='btn btn-default btn-lg'>
				<i class="fa fa-edit fa-fw"></i>
			</a>
			</td>
			<td>								
			<button @click="delItem(item)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<i class="fa fa-trash fa-fw"></i>
			</button>			
		</td>
	</tbody>	
	</table>
</div>
</div>
</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script src="/js/vue/FA.js"></script>