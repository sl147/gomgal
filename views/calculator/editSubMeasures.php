<?php include 'views/layouts/headerAdmin.php';?>

<div id="length">

	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<label>Виберіть тип калькулятора</label>
			<select v-model="typeCalc">
				<option v-for="type in types" v-bind:value="type.id">
					{{ type.name }} 
				</option>
			</select>
			<div v-if="showEdit">
			<h2 class="text-center"><?= $title?></h2>	
			
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>						
						<th class="text-center">тип калькулятора</th>
						<th class="text-center">найменування</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<tr v-for="elm in elements">
						<td class="text-center">
						<select v-model="elm.idCalculator" class='selectcl'>
							<option v-for="type in types" v-bind:value="type.id">
								{{ type.name }}
							</option>
						</select>
						</td>
						<td class="text-center">
							<input v-model="elm.name" type="text" style="width:300px;" />
						</td>

						<td>
							<button @click="editElement(elm)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</button>
						</td>
						<td>
							<button @click="deleteElement(elm)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
								<i class="fa fa-trash fa-fw"></i>
							</button>
						</td>	
					</tr>					
				</tbody>
			</table>

			<button @click="show=!show" class='btn btn-info'>Додати новий</button>
			
			<transition>
				<div v-if="show" class="">						
					<br>Найменування: <input style='width: 400px;' type = "text" v-model="newname" autofocus>
					калькулятор: 
					<select v-model="type" class='selectcl'>
						<option v-for="t in types" v-bind:value="t.id">
							{{ t.name }}
						</option>
					</select>
					<button @click="add2el()" class='btn btn-info'>
						<i class="fa fa-plus fa-fw"></i>
					</button>
				</div>
			</transition>
		</div>
		</div>
	</div>			
</div>

<?php include 'views/layouts/footerAdmin.php';?>

<script src="/js/vue/cSubMeasuresEdit.js"></script>