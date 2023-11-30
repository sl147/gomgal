<?php include 'views/layouts/headerAdmin.php';?>
<div id='edit'>
	<table class="table table-responsive table-bordered table-striped table-hover">

	<tbody v-for="item in albums">
		<td style="width: 70%;">{{item.name}}</td>
		<td>
			<a v-bind:href="/faEditOne/+item.id" title='редагувати запис' class='btn btn-default btn-lg'>
				<i class="fa fa-edit fa-fw"></i>
			</a>								
			<button @click="delItem(item)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<i class="fa fa-trash fa-fw"></i>
			</button>			
		</td>
	</tbody>	
	</table>
</div>
<?php include 'views/layouts/footerAdmin.php';?>

<script src="../js/vue/FA.js"></script>