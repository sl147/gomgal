<?php
require_once ('../models/AuxiliaryVue.php');

$cat    = trim(strip_tags($_GET['cat']));
$name   = trim(strip_tags($_GET['name']));

$MK   = new AuxiliaryVue();
$pr   = $MK->addElVote($name,$cat);

?>