<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/FA.php');

$MK   = new FA();
$pr    = $MK->updateFAVue(
				$_GET['id'],
				$_GET['name_FA'],
				$_GET['msgs_FA']
			);