<?
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Vote.php');

$MK   = new Vote();
$pr   = $MK->addVote(trim(strip_tags($_GET['voteid'])),
					 trim(strip_tags($_GET['count'])));