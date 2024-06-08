<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/News.php');

$data  = array();
$posts = [];
$page  = $_GET['page'];
$MK    = new News();
$posts = $MK->getAllNewsVue($page);

foreach ($posts as $item) {
  	$new_item = array(
		'id'    => $item['id'],
		'title' => $item['title'],
		'page'  => $page
	);
	array_push($data, $new_item);
}
	echo json_encode($data);