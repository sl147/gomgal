<?php include 'views/layouts/headerAdmin.php';?>
<div id="vue2el">
	<h2 class="text-center"><?= $title?></h2>
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<table class="table table-responsive table-bordered table-striped table-hover">
				<thead>
					<tr class='success'>
						<th></th>
						<th class="text-center">найменування</th>
					</tr>
				</thead>
				<tbody v-for="elm in elements">
					<tr>
						<td class="text-center">
							<button :key="elm.id" @click="getGroupItem(elm)" type="button" title="змінити статус" class="btn btn-info btn">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</td>
						<td class="text-center">
							{{elm.name}}
							<template v-if="elm.isPlus">
								<transition name="slide">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
										<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
											<table class="table table-responsive table-bordered table-striped table-hover">
												<tbody v-for="item in items">
													<tr>
														<td>{{item.msg}}</td>
														<td>{{item.countrl}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</transition>
							</template>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>
<script>window.table=<?= $json ?>;</script>
<script src="/js/vue/vue2el.js"></script>