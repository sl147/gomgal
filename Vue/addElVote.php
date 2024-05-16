<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Vote.php');

$cat    = trim(strip_tags($_GET['cat']));

$name   = trim(strip_tags($_GET['name']));

$MK   = new Vote();
$pr   = $MK->addElVote($name,$cat);