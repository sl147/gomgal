<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$id_FA    = trim(strip_tags($_GET['id']));
$subscribe  = trim(strip_tags($_GET['subscribe']));

$pr    = [];
$MK   = new FA();
$pr    = $MK->updateFAOneVue($id_FA,$subscribe);