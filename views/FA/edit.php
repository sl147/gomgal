<?php include 'views/layouts/headerAdmin.php';?>
<div id='edit'>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
				<table class="table table-responsive table-bordered table-striped table-hover">
					<thead>
						<tr class='success photoalbum'>
							<th class="text-center">ID</th>
							<th class="text-center">Назва фотоальбому</th>
							<th class="text-center">Опис фотоальбому</th>
							<th class="width_th_photoalbum text-center">редагувати назву і опис фотоальбому</th>
							<th class="width_th_photoalbum text-center">видалити фотоальбом</th>
							<th class="width_th_photoalbum text-center">редагувати фотографії</th>
						</tr>					
					</thead>
					<tbody>
						<tr v-for="item in albums" class="photoalbum">
						<td class="text-center">{{item.id_FA}}</td>
						<td class="text-center">
							<textarea rows="4" v-model="item.name_FA" type="text" class="width_td_photoalbum"></textarea>
						</td>
						<td class="text-center">
							<textarea rows="4" v-model="item.msgs_FA" type="text" class="width_td_photoalbum"></textarea>
						</td>
						<td class="text-center">
							<button @click="editFA(item)" type='button' title='редагувати опис назву фотоальбому' class='btn btn-default btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</button>
						</td>
						<td class="text-center">				
							<button @click="deleteFA(item)" type='button' title='видалити фотоальбом' class='btn btn-default btn-lg'>
								<i class="fa fa-trash fa-fw"></i>
							</button>			
						</td>
						<td class="text-center">
							<a v-bind:href="/faEditOne/+item.id_FA" title='редагувати фотографії фотоальбому' class='btn btn-default btn-lg'>
								<i class="fa fa-edit fa-fw"></i>
							</a>
						</td>
					</tr>
					</tbody>	
				</table>
						<?php if ($this->total > SHOWFA_BY_DEFAULT) :?>
			<div class="text-center"><? echo $pagination->get(); ?></div>
		<?endif ;?>
			</div>
		</div>
	</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script>
	window.table=<?= $json ?>;
</script>
<script src="/js/vue/FA.js"></script>