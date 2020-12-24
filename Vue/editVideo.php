<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../models/Video.php');

$id    = trim(strip_tags($_GET['id']));
$idYT  = trim(strip_tags($_GET['idYT']));
$title = trim(strip_tags($_GET['title']));

$pr    = [];
$MK    = new Video();
$pr    = $MK->updateVideoVue($id,$idYT,$title);
?>