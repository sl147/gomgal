<?php
require_once ('../models/AuxiliaryVue.php');

$id     = trim(strip_tags($_GET['id']));
$name   = trim(strip_tags($_GET['name']));
$tab    = trim(strip_tags($_GET['tab']));
$nameEl = trim(strip_tags($_GET['nameEl']));
$nameId = trim(strip_tags($_GET['nameId']));

$MK     = new AuxiliaryVue();
$pr     = $MK->updateVue2El($id, $name, $tab, $nameEl, $nameId);

?>