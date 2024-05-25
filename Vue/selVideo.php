<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Video.php');

$MK   = new Video();
$pr   = $MK->getVideoVue(trim(strip_tags($_GET['page'])));
$data = [];


foreach ($pr as $item) {
  	$new_item = array(
		'id'    => $item["prid"],
		'idYT'  => $item["pridYT"],
		'title' => $item["prhar"],
	);
	array_push($data, $new_item);
}
echo json_encode($data);