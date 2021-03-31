<?php
require_once ('../models/Calculator.php');

$id       = trim(strip_tags($_GET['id']));
$name     = trim(strip_tags($_GET['name']));
$k        = trim(strip_tags($_GET['k']));
$type     = trim(strip_tags($_GET['type']));
$subtype  = trim(strip_tags($_GET['subtype']));
$quantity = trim(strip_tags($_GET['quantity']));
$active   = trim(strip_tags($_GET['active']));

$MK       = new Calculator();
$pr       = $MK->updateVueReestrTab($id, $name, $k, $type, $subtype, $quantity, $active);
?>