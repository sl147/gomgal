<?php
require_once ('../models/Calculator.php');
$type = trim(strip_tags($_GET['type']));
$MK  = new Calculator();
echo json_encode($MK->selectCalc($type));
?>