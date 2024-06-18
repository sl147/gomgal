<?php

require_once ('../classes/classGetDB.php');
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetData.php');

$MK  = new classGetData ( trim(strip_tags($_GET['tab'])) );

echo json_encode($MK->selectFromTable(true, true));