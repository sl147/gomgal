<?php include 'views/Insurance/headerInsurance.php';?>
<?php include 'views/layouts/headerAdmin.php';?>
<div id="length">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div style="margin-top: 20px;">
				<label>Виберіть тип калькулятора</label>
				<select v-model="typeCalc">
					<option v-for="type in types" v-bind:value="type.id">
						{{ type.name }} 
					</option>
				</select>
			</div>
			<div v-if="showEdit">
			<h3 class="text-center">Редагування міри <b>{{ nameType }}</b></h3>	
			
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th class="text-center">найменування</th>
						<th class="text-center">коефіцієнт</th>
						<th class="text-center">тип</th>
						<th class="text-center">підтип</th>
						<th class="text-center">переглядів</th>
						<th class="text-center">популярні</th>
						<th></th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<tr v-for="elm in elements">
						<td class="text-center">
							<input v-model="elm.name" type="text" style="width:200px;" />
						</td>
						<td class="text-center">
							<input v-model="elm.k" type="number" step="0.1" style="width:150px;" />
						</td>
						<td class="text-center">
						<select v-model="elm.type" class='selectcl'>
							<option v-for="type in types" :value="type.id">
								{{ type.name }}
							</option>
						</select>
						</td>
						<td class="text-center">
							<select v-model="elm.subtype">
								<option v-for="sub in subs" :value="sub.id">
									{{ sub.name }} 
								</option>
							</select>
						</td>
						<td class="text-center">
							<input v-model="elm.quantity" type="number" style="width:80px;" />
						</td>
						<td class="text-center">
							<input v-model="elm.active" type="number" style="width:30px;" />
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
					коефіцієнт: <input style='width: 100px;' type = "number" v-model="k" step="0.1">
					<button @click="add2el()" class='btn btn-info'>
						<i class="fa fa-plus fa-fw"></i>
					</button>
				</div>
			</transition>
		</div>
		</div>
	</div>			
</div>

<script src="/js/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue-resource.min.js"></script>
<script src="/js/vue/cMeasuresEdit.js"></script>