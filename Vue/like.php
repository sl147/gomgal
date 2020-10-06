<?php
require_once ('../models/Relax.php');

$id    = $_GET['id'];
$count = $_GET['countrl'] + (1 * $_GET['val']);
$count = ($count < 0) ? 0 : $count;
$MK    = new Relax();
$res   = $MK->getLikeVue($id,$count);
?>