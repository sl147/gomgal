<div class="arhYear">
  <?php 
  $rowClass = new classArchive();
  $res = $rowClass->arhiveButton(2014,14);
  ?>
  <div id="арх14" class="collapse">
    <?for ($j = 5; $j < 12; $j++) {
      $m = $j + 1;
      echo "<a href='/archive/".$m."/2014'>".Auxiliary::getMonth()[$j]."</a><br>";
    }?>    
  </div>
  <?
  
  for ($i=2015; $i < date('Y'); $i++) {       
    $res = $rowClass->showArchive($i);        
  }
  $res = $rowClass->showArchiveCurrent(date('Y'));
  unset($rowClass);
  ?>
</div> 
<br><br>