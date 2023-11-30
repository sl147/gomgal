<?php
require_once ('../models/Calculator.php');

$name = trim(strip_tags($_GET['name']));
$k    = trim(strip_tags($_GET['k']));
$type = trim(strip_tags($_GET['type']));

$MK   = new Calculator();
$pr   = $MK->addVueReestrTab($name, $k, $type);

?>