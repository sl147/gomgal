<?
require_once "../dblinc.php";
global $link;
if (trim(strip_tags($_GET['nametab']))) $sql = "DELETE FROM ".trim(strip_tags($_GET['nametab']))." WHERE ".trim(strip_tags($_GET['nameid']))."='".intval(trim(strip_tags($_GET['id'])))."'";
if ($result = mysqli_query($link,$sql)) {
	$loc="Location:".$_SERVER['HTTP_REFERER'];
	header( $loc);
}
?>