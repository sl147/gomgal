<?php include 'views/layouts/headerAdmin.php';?>
<h2 class="text-center">Редагування голосування</h2>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<div id="voteAd">
		<table style='margin-bottom: 20px;'>
			<tr >
				<td class="text-center">
					<button @click="show=!show" class='btn btn-info'>Додати новий</button>
				</td>
			</tr>
			<transition name="slide">
				<tr v-show="show">
					<td>							
						<label class="labelTrans">код YouTube: </label>
						<input style='width: 200px;' type = "text" v-model="voteid" autofocus><br><br>
						<label class="labelTrans">титул: </label>
						<input style='width: 600px;' type = "text" v-model="nameVote">			
						<button @click="add()" class='btn btn-info' title="додати нове відео">
							<i class="fa fa-plus fa-fw"></i>
						</button>							
					</td>
				</tr>
			</transition>				
		</table>			
		<table class="table table-responsive table-bordered table-striped table-hover">
			<thead>
				<tr class='success'>
					<th class="text-center">титул</th>
					<th></th>
					<th></th>
				</tr>					
			</thead>
			<tbody>
				<tr v-for="vote in votes">
					<td class="text-center">
						<input v-model="vote.name" type="text" style="width:700px;" />
					</td>						

					<td>

						<button @click="edit(vote)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
							<i class="fa fa-edit fa-fw"></i>
						</button>
					</td>
					<td>
						<button @click="del(vote)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
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
<script src="/js/vue/editVoteAd.js"></script>