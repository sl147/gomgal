<?php include 'views/layouts/headerAdmin.php';?>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<h2 class="text-center">Редагування відео</h2>
	<div id="vueVideo">
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
						<input style='width: 200px;' type = "text" v-model="newidYT" autofocus><br><br>
						<label class="labelTrans">титул: </label>
						<input style='width: 600px;' type = "text" v-model="newTitle">	
						<button @click="add()" class='btn btn-info' title="додати нове відео">
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
					<th class="text-center">код YouTube</th>
					<th class="text-center">Опис відео</th>
					<th></th>
					<th></th>
				</tr>					
			</thead>
			<tbody>
				<tr v-for="video in videos">
					<td class="text-center">
						<object>
							<param name="movie" :value="'//www.youtube.com/v/'+video.idYT+'?hl=uk_UA&amp;version=3'">
							<param name="allowFullScreen" value="true">
							<param name="allowscriptaccess" value="always">
							<embed :src="'//www.youtube.com/v/'+video.idYT+'?hl=uk_UA&amp;version=3'" type="application/x-shockwave-flash" width="150" height="94" allowscriptaccess="always" allowfullscreen="true"></embed>
						</object>				
					</td>
					<td class="text-center">
						<input v-model="video.idYT" type="text" style="width:150px;" />
					</td>
					<td  class="text-center">
						<textarea v-model="video.title" row='4' col='4' type="text" style="width:400px; font-size: 12px;" /></textarea>
					</td>						
					<td>
						<button @click="edit(video)" type='button' title='редагувати запис' class='btn btn-default btn-lg'>
							<i class="fa fa-edit fa-fw"></i>
						</button>
					</td>
					<td>
						<button @click="del(video)" type='button' title='видалити запис' class='btn btn-default btn-lg'>
							<i class="fa fa-trash fa-fw"></i>
						</button>
					</td>	
				</tr>					
			</tbody>				
		</table>
		<?php if ($this->total > SHOWVIDEO_BY_DEFAULT_ADMIN) :?>
			<div class="text-center"><? echo $pagination->get(); ?></div>
		<?endif ;?>
	</div>
</div>
</div>

<?php include 'views/layouts/footerAdmin.php';?>

<script>
	window.table=<?= $json ?>;
</script>
<script src="/js/vue/vueVideo.js"></script>