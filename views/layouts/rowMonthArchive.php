<div id="арх<?=$year2?>" class="collapse">
  <?for ($j = 0; $j < $month; $j++) {
      $m = $j + 1;
      echo "<a href='/archive/".$m."/".$year."'>".Auxiliary::getMonth()[$j]."</a><br>";
  }?>
</div>