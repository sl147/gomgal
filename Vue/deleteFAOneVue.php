<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FAOne.php');

$id = trim(strip_tags($_GET['id']));
$MK = new FAOne();
$pr = $MK->deleteFAOneVue($id);