<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../classes/classGetData.php');
require_once ('../models/Video.php');

$MK    = new Video();
$pr    = $MK->addVideoVue(trim(strip_tags($_GET['idYT'])),
						  trim(strip_tags($_GET['title']))
						);