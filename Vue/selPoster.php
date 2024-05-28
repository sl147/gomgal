<?php

require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Poster.php');

$page  = intval($_GET['page']) ?? 1;
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