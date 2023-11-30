<?php
require_once ('../models/NewsVue.php');

$page  = $_GET['page'];
$MK    = new NewsVue();
$comms = [];
$comms = $MK->getAllCommentsVue($page);
$data  = [];

foreach ($comms as $item) {
  	$new_item = array(
		'id'        => $item['id'],
		'id_cl'     => $item['id_cl'],
		'txt_com'   => $item['txt_com'],
		'nik_com'   => $item['nik_com'],
		'email_com' => $item['email_com'],
		'ip_com'    => $item['ip_com'],
		'page'      => $page,
	);
	array_push($data, $new_item);
}
	echo json_encode($data, JSON_HEX_QUOT |  JSON_HEX_TAG);
?>