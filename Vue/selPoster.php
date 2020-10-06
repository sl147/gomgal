<?php
require_once ('../models/Poster.php');

$page  = intval($_GET['page']);
$MK    = new Poster();

$posts = $MK->getAllPostersVue($page);
$data = [];

foreach ($posts as $item) {
  	$new_item = array(
		'id'      => $item['id'],
		'title_p' => $item['title_p'],
		'page'    => $page,
	);
	array_push($data, $new_item);
}
echo json_encode($data);
?>