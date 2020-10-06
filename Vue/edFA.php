<?php
require_once ('../models/FA.php');

$MK   = new FA();
$pr   = $MK->updateFAVue($_GET['id'],$_GET['subscribe']);
?>