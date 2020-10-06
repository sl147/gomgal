<?php
require_once ('../models/Auxiliary.php');

$id    = trim(strip_tags($_GET['id']));
$name  = trim(strip_tags($_GET['name']));

$pr   = array();
$MK   = new Auxiliary();
$pr   = $MK->updateVoteVue($id,$name);

?>