<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/Video.php');

$idYT  = trim(strip_tags($_GET['idYT']));
$title = trim(strip_tags($_GET['title']));
$pr    = [];
$MK    = new Video();
$pr    = $MK->addVideoVue($idYT,$title);
?>