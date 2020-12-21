<?php
require_once ('../models/Vote.php');

$id    = trim(strip_tags($_GET['id']));
$name  = trim(strip_tags($_GET['name']));

$pr   = [];
$MK   = new Vote();
$pr   = $MK->updateVoteVue($id,$name);
?>