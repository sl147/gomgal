<?php
require_once ('../models/Auxiliary.php');

$cat    = trim(strip_tags($_GET['cat']));
$name   = trim(strip_tags($_GET['name']));

$MK   = new Auxiliary();
$pr   = $MK->addElVote($name,$cat);

?>