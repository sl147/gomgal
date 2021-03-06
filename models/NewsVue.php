<?php
/**
 * Description of ewsVue
 *
 * @author sl147
 */
class NewsVue
{
	const SHOWNEWS_BY_DEFAULT_Vue=25;

	public function __construct()
	{
		require_once ('../classes/traitAuxiliary.php');
		require_once ('../classes/classGetDB.php');
	}

	public function getAllCommentsVue($page = 1)
	{

		$getData = new classGetData('Comment');
		$result  = $getData->getDataFromTableOrderPageVueWithoutGetRow(self::SHOWNEWS_BY_DEFAULT_Vue,$page,'id_com');
		unset($getData);
		$i       = 0;
		while ($row = $result->fetch()) {
			$list[$i]['id']        = $row['id_com'];
			$list[$i]['id_cl']     = $row['id_cl'];
			$list[$i]['txt_com']   = $row['txt_com'];
			$list[$i]['nik_com']   = $row['nik_com'];
			$list[$i]['email_com'] = $row['email_com'];
			$list[$i]['ip_com']    = $row['ip_com'];			
			$i++;
		}
		return $list ?? [];
	}

	public function getAllNewsVue($page = 1)
	{
		require_once ('../classes/classGetData.php');
		$getData  = new classGetData('msgs');
		$list = $getData->getDataFromTableOrderPageVue(self::SHOWNEWS_BY_DEFAULT_Vue,$page,'id');
		unset($getData);
		return $list ?? [];
	}
}