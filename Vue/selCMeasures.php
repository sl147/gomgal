<?php

require_once ('../classes/classGetDB.php');
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetData.php');

$MK  = new classGetData ( trim(strip_tags($_GET['tab'])) );

//echo json_encode($MK->selectFromTableWHERE( array(), true, true));

echo json_encode($MK->selectDataFromTable( array(), '', 0, 'DESC', true, true);