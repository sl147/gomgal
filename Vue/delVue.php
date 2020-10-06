<?
require_once ('../models/Auxiliary.php');

$id      = trim(strip_tags($_GET['id']));
$nameId  = trim(strip_tags($_GET['nameId']));
$nameTab = trim(strip_tags($_GET['nameTab']));

$MK      = new Auxiliary();
$pr      = $MK->delVue2El($id, $nameTab, $nameId);
?>