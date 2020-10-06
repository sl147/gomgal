<?php include 'views/layouts/header.php';?>
<div id='editOne'>
<h2 class='text-center'>Редагування<br><?=$nameFA['name_FA']?></h2>
<table class="table table-responsive table-bordered table-striped table-hover">
	<thead>
		<th class="text-center">фото</th>
		<th class="text-center">підпис фото</th>
		<th></th>

	</thead>
	<tbody v-for="item in albums">
		<td class="tdImgWidth">
			<div v-if='item.isFile'>
			<a class='fancybox' id='foto' v-bind:title='item.subscribe' v-bind:href='item.fotoName'>
                <img v-bind:alt='item.subscribe' width='100' height='100' v-bind:src='item.fotoName'>
             </a>
             </div>			
		</td>
		<td >
			<textarea class="tdTextareaWidth" rows=4 type = "text" v-model="item.subscribe" autofocus>
				</textarea>
		</td>
		<td class="tdButtonWidth">
			<div class="tdButtonheight">
			<button @click="edItem(item)" class='btn btn-default btn-lg'>
				<i class="fa fa-edit fa-fw"></i>
			</button>
							
			<button @click="delItem(item)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
				<i class="fa fa-trash fa-fw"></i>
			</button>			
			</div>
		</td>
	</tbody>
</table>
				<div class="text-center">
					<button @click="show=!show" class='btn btn-info'>Додати нове фото</button>
				</div>			
				<transition name="slide">
					<div v-show="show" class="text-center">
						<form action="/uploadDZ" id="my-awesome-dropzone" class="dropzone"> 
							<button type='submit' class='btn btn-info'>
								ub
							</button>
						</form>

						<div v-if="!image">
						    <h2>Select an image</h2>
						    <input class='dropzone' type="file" @change="onFileChange">
						</div>
						<div v-else>
							<img :src="image" />
							<button @click="removeImage">
								Remove image
							</button>
						</div>					
					</div>
				</transition>
		
</div>
<?php include 'views/layouts/footer.php';?>
<script>
window.table=<?= $json ?>;
</script>
<script src="../js/vue/FAOne.js"></script>