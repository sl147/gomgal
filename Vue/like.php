<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Relax.php');

$count = $_GET['countrl'] + (1 * $_GET['val']);
$MK    = new Relax();
$res   = $MK->getLike(
				$_GET['id'],
				($count < 0) ? 0 : $count
			);