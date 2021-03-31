<?php
require_once ('../models/Calculator.php');

$id = trim(strip_tags($_GET['id']));
$q  = trim(strip_tags($_GET['q']));

$MK = new Calculator();
$pr = $MK->updateVueQuantity($id, $q);
?>