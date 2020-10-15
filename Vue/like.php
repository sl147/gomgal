<?php
require_once ('../models/RelaxVue.php');

$count = $_GET['countrl'] + (1 * $_GET['val']);
$count = ($count < 0) ? 0 : $count;
$MK    = new RelaxVue();
$res   = $MK->getLikeVue($_GET['id'],$count);
?>