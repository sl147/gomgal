<?php include 'views/insurance/headerInsurance.php';?>
	<div id="length">
		<!-- <img src="../image/1.jpg" class="bgFull"> -->
		
		<div class="container-fluid" v-cloak>
			<div class="row">				
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<?php include 'views/Insurance/insLeftSide.php';?>
				</div>
				<div class='authCalc col-lg-6 col-md-6 col-sm-10 col-xs-12'>
					<div class="row addSpace">
						<div class='text-center col-lg-2 col-md-2 col-sm-4 col-xs-4'>
							тип калькулятора
						</div>
						<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
							<select v-model="typeCalc">
								<option v-for="type in types" :value="type.id">
									{{ type.name }} 
								</option>
							</select>
						</div>
					</div>
					<div v-if="show">
						<div class="row addSpace">
							<div class='col-lg-2 col-md-2 col-sm-4 col-xs-4'>
								Перевести
							</div>
							<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
								<select v-model="first">
									<option v-for="var1 in elements" :value="var1">
										{{ var1.name }} 
									</option>
								</select>
							</div>
						</div>
						<div class="row addSpace">								
							<div class='text-center col-lg-2 col-md-1 col-sm-4 col-xs-4'>
								в
							</div>
							<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'>
								<select v-model="second">
									<option v-for="var2 in elements" :value="var2">
										{{ var2.name }}
									</option>							
								</select>
							</div>							
						</div>
						<div class="row addSpace">
							<div class='col-lg-2 col-md-2 col-sm-4 col-xs-4'>
								кількість:
							</div>
							<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
								<input class="btn btn-primary" type="number" v-model="quantity"/>
								<!-- <input class="btn btn-primary" :style="l" type="number" v-model="quantity"/> -->
							</div>
						</div>
						<table class="table table-responsive table-bordered table-striped table-hover">
							<thead>
								<tr class='success'>
									<th class="text-center">од. виміру</th>
									<th class="text-center">містить</th>
									<th class="text-center">од. виміру</th>
								</tr>									
							</thead>
							<tbody>
								<tr>
									<td class="text-center">{{first.name}}</td>
									<td class="text-right" style="width: 200px;">{{ result }}</td>
									<td class="text-center">{{second.name}}</td>
								</tr>
								<tr v-for="type in typesActive">								
									<td></td>
									<td class="text-right">{{resActive(type)}}</td>
									<td class="text-center">{{type.name}}</td>
								</tr>
							</tbody>
						</table>
					</div>								
				</div>
				<div class="col-lg-3 col-md-3 col-sm-10 col-xs-12">
					<form id = "formCom" method="POST">
						<fieldset>
							<legend class="text-center">Додати коментар</legend>
							<label class="text-center">Ім'я</label>
							<input name="nik_com" type="text"><br><br>
							<label class="text-center">Коментар</label>
							<textarea align='center' name = "txt_com" rows ='3' maxlength="2000"></textarea>
							<input id="check" name="check" type="hidden" value="" />
							<div class="text-center">
								<button name="submit" type="submit" class="btn btn-info btn-block">додати</button>
							</div>
						</fieldset>
					</form><br>

					<? if (empty($comment)) :?>
						<div class="text-center">
					    <h4>Коментарів немає</h4>
					    </div>
					<? else :?>
					<h5 class="text-center">Коментарів <?= count($comment)?></h5>
					    <?php foreach ($comment as $item) :?>					    	
					        <p class='text-left ip_Comment'><?=$item['nik'] ?> :</p>
					        <p class="news_Comment"><?=$item['text'] ?></p>
					        <br>
					    <?php endforeach; ?>	
					<? endif; ?>						
				</div>
			</div>
		</div>
	</div>
<script src="/js/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue-resource.min.js"></script>
<script src="/js/vue/cMeasures.js"></script>