<?php
require_once ('../models/News.php');

$page  = $_GET['page'];
$posts = [];
$MK    = new News();

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