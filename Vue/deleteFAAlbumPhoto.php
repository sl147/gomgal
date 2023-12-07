<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$MK = new FA();
$pr = $MK->deleteFAAlbumPhoto( trim(strip_tags($_GET['id'])) );