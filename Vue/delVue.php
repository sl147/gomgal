<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/AuxiliaryVue.php');

$MK      = new AuxiliaryVue(trim(strip_tags($_GET['tab'])));

$pr      = $MK->delVue2El(trim(strip_tags($_GET['id'])),
 						  trim(strip_tags($_GET['nameId']))
 						);