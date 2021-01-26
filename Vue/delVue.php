<?
require_once ('../models/AuxiliaryVue.php');

$id      = trim(strip_tags($_GET['id']));
$nameId  = trim(strip_tags($_GET['nameId']));
$nameTab = trim(strip_tags($_GET['nameTab']));

$MK      = new AuxiliaryVue();
$pr      = $MK->delVue2El($id, $nameTab, $nameId);
?>