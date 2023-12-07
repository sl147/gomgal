<?php
require_once ('../classes/traitAuxiliary.php');
require_once ('../classes/classGetDB.php');
require_once ('../models/FA.php');

$id        = trim(strip_tags($_GET['id']));
$fotoName  = trim(strip_tags($_GET['fotoName']));
$fotoNames = trim(strip_tags($_GET['fotoNames']));
$idAlbum   = trim(strip_tags($_GET['idAlbum']));

$pr = [];
$MK = new FA();
$pr = $MK->deleteFAOnePhoto( $id, $fotoName, $fotoNames, $idAlbum );