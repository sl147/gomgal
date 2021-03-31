<?php
require_once ('../classes/classGetDB.php');
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetData.php');
$tab = trim(strip_tags($_GET['tab']));
$MK  = new classGetData($tab);

$data = [];
$new_item  = array(
			'id'       =>1,
			'name'     => 'name',
			'tab'   => $tab,
			);
array_push($data, $new_item);
//echo json_encode($data);
echo json_encode($MK->getDataFromTableVue());
?>