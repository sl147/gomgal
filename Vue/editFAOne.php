<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/FA.php');

$MK = new FA();
$pr = $MK->updateFAOneVue(
			trim(strip_tags($_GET['id'])),
			trim(strip_tags($_GET['subscribe']))
		);