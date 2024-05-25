<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Vote.php');

$MK   = new Vote();
$pr   = $MK->addElVote(trim(strip_tags($_GET['name'])),
					   trim(strip_tags($_GET['cat']))
					);