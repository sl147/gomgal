<?
require_once ('../classes/traitAuxiliary.php');
require_once ('../models/Video.php');

$idYT  = trim(strip_tags($_GET['idYT']));
$title = trim(strip_tags($_GET['title']));

$pr   = array();
$MK   = new Video();
$pr   = $MK->addVideoVue($idYT,$title);

?>