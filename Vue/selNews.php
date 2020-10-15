<?php
require_once ('../models/NewsVue.php');

$page  = $_GET['page'];
$posts = [];
$MK    = new NewsVue();

$posts = $MK->getAllNewsVue($page);
$data  = [];
foreach ($posts as $item) {
  	$new_item = array(
		'id'    => $item['id'],
		'title' => $item['title'],
		'page'  => $page
	);
	array_push($data, $new_item);
}
	echo json_encode($data);
?>