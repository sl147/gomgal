<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//namespace models;

/**
 * Description of ewsVue
 *
 * @author sl147
 */
class NewsVue
{
    const SHOWNEWS_BY_DEFAULT = 25;
		
	public function __construct() {
		require_once ('../classes/traitAuxiliary.php');
		require_once ('../classes/classGetDB.php');
		require_once ('../classes/classGetData.php');
	}

	public function getAllCommentsVue($page = 1) {

		$getData = new classGetData('Comment');
		$result  = $getData->getDataFromTableOrderPageVueWithoutGetRow(self::SHOWNEWS_BY_DEFAULT,$page,'id_com');
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
		return $list;
	}

	public function getComsByIdVue($id, $page) {

		$getData = new classGetData('Comment');
		$list = $getData->getDataFromTableByNameVue($id,'id_com');
		unset($getData);
		return $list;
	}

	public function getAllNewsVue($page = 1) {

		$getData  = new classGetData('msgs');
		$list = $getData->getDataFromTableOrderPageVue(self::SHOWNEWS_BY_DEFAULT,$page,'id');
		unset($getData);
		return $list;
	}
}