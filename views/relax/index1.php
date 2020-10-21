<?php include_once 'views/relax/headerRelax.php';?>

<div id='relax'>	
	<div v-for="item in relaxes">
		<p style='font-size: 15px;' v-html="item.msg"></p>					
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