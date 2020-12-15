<?
require_once ('../models/Vote.php');

$MK   = new Vote();
$pr   = $MK->addVote(trim(strip_tags($_GET['voteid'])));
?>