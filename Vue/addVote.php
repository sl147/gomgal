<?
require_once ('../models/Auxiliary.php');

$voteid = trim(strip_tags($_GET['voteid']));

$MK   = new Auxiliary();
$pr   = $MK->addVote($voteid);
?>