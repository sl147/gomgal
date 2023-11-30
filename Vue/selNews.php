<?php
require_once ('../models/NewsVue.php');
$data  = [];
$posts = [];
$page  = $_GET['page'];
$MK    = new NewsVue();
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
?>