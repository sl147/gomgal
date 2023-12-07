<?php include 'views/layouts/headerAdmin.php';?>
<div id='editOne'>
	<h2 class='text-center'>Редагування фотоальбому<br><?php echo $nameFA['name_FA']?></h2>

		<div class="text-center">
		<button @click="show=!show" class='btn btn-info'>Додати нове фото</button>
	</div>			
	<transition name="slide">
		<div v-show="show" class="text-center">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<form method='POST' class="form_Photo" enctype="multipart/form-data">
							<input type="hidden" name="if_photo" v-model="id" />
							<label>Виборати фотографію</label>
							<input type="file" name="photo"  accept="image/*,image/jpeg"><br><br>
							<label for="desc_photo">Опис фото</label>

							<textarea type="text" rows ='3' cols = '55' name="desc_photo"></textarea>
							<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
								Додати фотографію
							</button>
						</form>
					</div>
				</div>
			</div>
<!-- 						<form action="/uploadDZ" id="my-awesome-dropzone" class="dropzone"> 
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
						</div>	 -->				
					</div>
				</transition>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<table class="table table-responsive table-bordered table-striped table-hover">
					<thead>
						<tr class='success photoalbum'>
							<th class="text-center">ID</th>
							<th class="text-center">фото</th>
							<th class="text-center">підпис фото</th>
							<th class="width_th_photoalbum text-center">редагувати підпис фото</th>
							<th class="width_th_photoalbum text-center">видалити фотоальбом</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="item in albums" class="photoalbum">
							<td class="text-center">{{ item.id }}</td>
							<td class="tdImgWidth">
								<div v-if='item.isFile'>
									<a class='fancybox' id='foto' v-bind:title='item.subscribe' v-bind:href='item.fotoName'>
										<img v-bind:alt='item.subscribe' width='200' height='auto' v-bind:src='item.fotoName'>
									</a>
								</div>			
							</td>
							<td >
								<textarea class="tdTextareaWidth" rows=7 type = "text" v-model="item.subscribe" autofocus>
								</textarea>
							</td>
							<td class="text-center">
								<div class="tdButtonheight1">
									<button @click="editFAOne(item)" class='btn btn-default'>
										<i class="fa fa-edit fa-fw"></i>
									</button>
								</div>
							</td>
							<td class="text-center">
								<div class="tdButtonheight1">
									<button @click="deleteFAOne(item)" type='button' title='видалити запис' class='btn btn-default'>
										<i class="fa fa-trash fa-fw"></i>
									</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

			</div>
			<?php include 'views/layouts/footerAdmin.php';?>
			<script>
				window.table=<?= $json ?>;
			</script>
			<script src="../js/vue/FAOne.js"></script>