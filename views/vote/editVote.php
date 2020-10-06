<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">
	<h2 class="text-center"><?= $title?></h2>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<table style='margin-bottom: 20px;'>
				<tr class="text-center">
					<td>
						<button @click="show=!show" class='btn btn-info'>Додати новий</button>
					</td>
				</tr>
				<transition name="slide">
					<tr v-show="show">
						<td class="text-center">							
							<br>Найменування: <input style='width: 700px;' type = "text" v-model="newname" autofocus>
							<button @click="add2el()" class='btn btn-info'>
								<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
							</button>							
						</td>
					</tr>
				</transition>				
			</table>			
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th></th>
						<th class="text-center">найменування</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					
					<tr v-for="elm in elements">
						<td class="text-center">
							<a class='btn btn-info' v-bind:href="/voteOne/+elm.id">
								<i class="fa fa-plus fa-fw"></i>
							</a>
						</td>
						<td class="text-center">
							<input v-model="elm.name" type="text" style="width:700px;" />
						</td>
						<td>
							<button @click="edit2el(elm)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</button>
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

<?php include 'views/layouts/footerAdmin.php';?>

<script>
	window.table=<?= $json ?>;
	window.coun=<?= $countEl ?>;
</script>

<script src="/js/vue/vue2el.js"></script>