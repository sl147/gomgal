<?php
require_once ('../models/AuxiliaryVue.php');

$id     = trim(strip_tags($_GET['id']));
$tab    = trim(strip_tags($_GET['tab']));
$nameId = trim(strip_tags($_GET['nameId']));

$MK     = new AuxiliaryVue();
$pr     = $MK->delVue2El($id, $tab, $nameId);
?>