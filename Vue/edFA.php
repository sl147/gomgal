<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$id_FA    = trim(strip_tags($_GET['id']));
$name_FA  = trim(strip_tags($_GET['name_FA']));
$msgs_FA = trim(strip_tags($_GET['msgs_FA']));

$pr    = [];
$MK   = new FA();
$pr    = $MK->updateFAVue($id_FA,$name_FA,$msgs_FA);