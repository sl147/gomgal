<h5 class="text-center showKursValut">курси валют Приватбанку</h5>
<table class="text-center showKursValut">
	<thead>
		<tr>
			<th class="text-center">валюта</th>
			<th class="text-center">купівля</th>
			<th class="text-center">продаж</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($result as $item) :?> 
		<?php if (($item['ccy'] == 'USD') OR ($item['ccy'] == 'EUR')) :?>
			<tr>
				<td class="text-center"><?= $item['ccy']?></td>
				<td class="text-center"><?= sprintf("%01.2f", $item['buy'])?></td>
				<td class="text-center"><?= sprintf("%01.2f", $item['sale'])?></td>
			</tr>
		<?php endif; ?>
		<?php endforeach; ?>		
	</tbody>
</table>