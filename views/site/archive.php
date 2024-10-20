<!-- <div class="arhYear">
	<div class="row">	
	<?php for ($year=2014; $year <= date('Y'); $year++) : ?>
		<?
			$year2 = $year - 2000;
			$arxYear = "арх".$year2;
		?>		
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
				<button type="button" class="btn btn-info btn-sm " data-toggle="collapse" data-target="#<?=$arxYear?>" aria-expanded="true" aria-controls="<?=$arxYear?>">
					Архів <?= $year?>
				</button>
				<div id="арх<?=$year2?>" class="collapse">
					<?
						$month = ($year == date('Y')) ? date("n")-1 : 12;
						$start = ($year == 2014) ? 7 : 0;
						for ($j = $start; $j < $month; $j++) {
							$m = $j + 1;
							echo "<a href='/archive/".$m."/".$year."'>".Auxiliary::getMonth()[$j]."</a><br>";
						}
					?>
				</div>
				</div>
				<?php endfor;	?>	
	</div>
</div>  -->
<h2 class="text-center">АРХІВИ</h2>
<div class="arhYear">
	<table class="table">
		<tbody>
			<tr>
					<?php $row = 0; for ($year=2014; $year <= date('Y'); $year++) : ?>
						<?
							$year2 = $year - 2000;
							$arxYear = "арх".$year2;
							$row ++;
							if ($row == 7) {
								$row = 0;
								echo '</tr><tr>';
							}
						?>		
				<td>
					<button type="button" class="btn btn-info btn-sm " data-toggle="collapse" data-target="#<?=$arxYear?>" aria-expanded="true" aria-controls="<?=$arxYear?>">
						Архів <?= $year?>
					</button>
						<div id="арх<?=$year2?>" class="collapse">
							<?
								$month = ($year == date('Y')) ? date("n")-1 : 12;
								$start = ($year == 2014) ? 7 : 0;
								for ($j = $start; $j < $month; $j++) {
									$m = $j + 1;
									echo "<a href='/archive/".$m."/".$year."'>".Auxiliary::getMonth()[$j]."</a><br>";
								}
							?>
						</div>
					</td>
				<?php endfor;	?>
			</tr>
		</tbody>
	</table>
</div>