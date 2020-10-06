<?php
require_once ('../models/Auxiliary.php');

$name   = trim(strip_tags($_GET['name']));
$tab    = trim(strip_tags($_GET['tab']));
$nameEl = trim(strip_tags($_GET['nameEl']));

$MK   = new Auxiliary();
$pr   = $MK->addVue2El($name, $tab, $nameEl);

?>