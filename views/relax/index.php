<?php include_once 'views/relax/headerRelax.php';?>

<div id='relax'>	
	<div v-for="item in relaxes">
		<p style='font-size: 15px;' v-html="item.msg"></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					Оцініть
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3">
					<button @click="edCount(item,1)" type="button" data-toggle="dropdown" class="btn btn-delta11">
						<i class="fa fa-plus fa-fw"></i>
					</button>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3">
					<button @click="edCount(item,-1)" type="button" data-toggle="dropdown" class="btn btn-delta11">
						<i class="fa fa-minus fa-fw"></i>
					</button>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
					<span class='badge'>
						{{item.countrl}}
					</span>
				</div>
			</div>
		</div>					
		<hr>
	</div>
	<?php if ($total > SHOWRELAX_BY_DEFAULT) :?>
		<div class="text-center"><? echo $pagination->get(); ?></div>
	<?endif ;?>
</div>

<script>
	window.table=<?= $json ?>;
</script>

<script src="/js/vue/relax.js"></script>