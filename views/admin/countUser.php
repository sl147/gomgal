<?php include 'views/layouts/headerAdmin.php';?>
<h2 class='text-center'>Відвідуваність сайту</h2>
<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<table class='table table-hover table-bordered table-striped table-responsive'> 
	<thead>
		<tr class='success' style='color: grey; font-size:12px; font-weight:bold;'>
			<th class="text-center">дата</th>
			<th class="text-center showLarge">відвідувачів</th>
			<th class="text-center showLarge">переглядів</th>
			<th class="text-center showLarge">в середньому</th>
		</tr>
	</thead>
	<tbody>
	<?php $j=1; foreach ($visitList as $item) :?>
		<tr>
			<td class="text-center"><?php echo $item['date']?></td>
			<td class="text-center"><?php echo $item['hosts']?></td>
			<td class="text-center"><?php echo $item['views']?></td>
			<td class="text-center"><?php echo $item['views'] / $item['hosts']?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>
<?php include 'views/layouts/footerAdmin.php';?>