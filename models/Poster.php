<?php
/**
* 
*/

class Poster  extends classGetDB {
	use traitAuxiliary;

	public function __construct() {
		$this->poster   = new classGetData('poster');
		$this->category = new classGetData('catagory');
		$this->show     = 25;
	}

	public function getPosters20() {
		return $this->poster->selectDataFromTable( array( 'active' => 0 ), 'id_poster', 20);
	}

	public  function getAllPostersImpotCat( int $cat) {
		$args = array(
			'cat_p' => $cat,
			'impot' => 1,
			'active' => 0
		);
		return $this->poster->selectDataFromTable( $args, 'id_poster');
	}

	public function getAllPostersImpot() {
		$args = array(
			'impot' => 1,
			'active' => 0
		);
		return $this->poster->selectDataFromTable( $args, 'id_poster');
	}

	public  function getAllPostersAllCat( int $cat, int $page = 1) {
		$args = array(
			'cat_p' => $cat,
			'active' => 0
		);
		return $this->poster->selectDataFromTable( $args, 'id_poster', SHOWPOSTER_BY_DEFAULT, 'DESC', true, false, false, true, $page );
	}

	private function getListArr($sql) {
		$result = $this->getDB($sql);
		while ($row = $result->fetch()) {
			$list[]=$row;
		}
		return $list ?? [];
	}

	public function getAllPostersAll($page = 1)	{
		return $this->poster->selectDataFromTable( array( 'active' => 0), 'id_poster', SHOWPOSTER_BY_DEFAULT, 'DESC', true, false, false, true, $page );
	}

	public  function getFindPosters($txt,$page = 1)	{
		$offset   = ($this->getIntval($page) - 1) * SHOWPOSTER_BY_DEFAULT;
		$sql      = "SELECT * FROM poster WHERE (active= 0) and ((impot=0) OR (impot IS NULL)) and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC LIMIT ".SHOWPOSTER_BY_DEFAULT." OFFSET $offset";
		return $this->getListArr($sql);
	}

	public  function getFindPostersImpot($txt)	{
		$sql  = "SELECT * FROM poster WHERE (active= 0) and (impot='1') and (LOCATE('".$txt."',msg_p)) ORDER BY id_poster DESC";
		return $this->getListArr($sql);
	}

	public function getFormat($i) {
		return ($i) ? $i : '-';
	}

	public function getPostersVerify()	{
		$category = $this->category->selectDataFromTable( array(), "", 0, 'DESC', false);
		while ($row = $category->fetch()) {
			for ($j=0; $j < 6; $j++) { 
				$count_all[$j][$row['id_cat']] = 0;
			}
		}
		$result = $this->poster->selectDataFromTable( array(), "", 0, 'DESC', false);
		while ($row = $result->fetch()) {
		    $type_p = $this->getIntval($row['type_p']);
		    $cat_p  = $this->getIntval($row['cat_p']);
		    $count_all[$type_p][$cat_p] +=1;
		}
		$type_cat = $this->getTypeCategory();
		while ($row = $category->fetch()) {
            $id_cat = $row['id_cat'];
            $args = array(
            	'count_buy'    => $count_all[1][$id_cat],
            	'count_sell'   => $count_all[2][$id_cat],
            	'count_other'  => $count_all[3][$id_cat],
            	'count_change' => $count_all[4][$id_cat],
            	'count_job'    => $count_all[5][$id_cat]
            );
            $this->category->updateDataInTable( $args, array( 'id_cat'=>$id_cat ) );
		}
	}

	public  function getPostersCatEd() {
		return $this->category->selectDataFromTable( array(), 'cat_cat');
	}

	public function getPostersCat()	{
		for ($j=0; $j < 6; $j++) { 
			$count_all_in_column[$j] = 0;
		}
		$count_all_posters = 0;
		$result = $this->category->selectDataFromTable( array(), 'cat_cat', 0, 'ASC', false);
		$type_cat = $this->getTypeCategory();
		$i      = 1;
		while ($row = $result->fetch()) {
			$count_all              = 0;
			$catList[$i]['id']      = $row['id_cat'];
			$catList[$i]['cat_cat'] = $row['cat_cat'];

			for ($j=1; $j < 6; $j++) { 
				$catList[$i][$type_cat[$j]] = $this->getFormat($row[$type_cat[$j]]);
				$count_all_in_column[$j] += $row[$type_cat[$j]];
				$count_all      += $row[$type_cat[$j]];
			}

			$catList[$i]['count_all'] = $this->getFormat($count_all);
			$count_all_posters   +=  $count_all;
			$i++;
		}
			$catList[$i]['id']           = 0;
			$catList[$i]['cat_cat']      = 'all';

			for ($j=1; $j < 6; $j++) { 
				$catList[$i][$type_cat[$j]] = $this->getFormat($count_all_in_column[$j]);
			}
			$catList[$i]['count_all']    = $this->getFormat($count_all_posters);
		return $catList;
	}

	public  function getPosterByRand( int $rand )	{
		$args = array(
			'rand_p' => $rand,
			'active' => 0
		);
		return $this->poster->selectDataFromTable( $args, "", 0, 'DESC', false, false, true);
	}

	public  function getPosterById( int $id )	{
		$args = array(
			'id_poster' => $id,
			'active'    => 0
		);
		return $this->poster->selectDataFromTable( $args, "", 0, 'DESC', false, false, true);
	}

	public function plusId($id) {
		return $this->poster->updateCountPlusOne( array( 'id_poster'=>$id ) );
	}

	public  function getFindTotalPoster($txt) {
		return $this->poster->selectCountFind( array( 'msg_p' => $txt ), false);
	}

	public function updateFoto($id,$foto) {
		return $this->poster->updateDataInTable( array( 'foto_p1' => $foto ), array('id_poster'=>$id) );
	}

	public  function getPostersByCat(int $cat) {
		return $this->category->selectDataFromTable( array( 'id_cat'=> $cat), "", 0, 'DESC', false, false, true );
	}

	public function getAllTypePost() {
		return array("вибрати тип","куплю","продам","оренда","обмін","послуги");
	}

	private function getTypeCategory(){
		return array( '', 'count_buy', 'count_sell', 'count_other', 'count_change', 'count_job' );
	}

	public  function getTypePost(int $type) {
		return $this->getAllTypePost() [$type];
	}

	public function incrementTypeCategory(int $cat, int $type) {
		$row = $this->getPostersByCat($cat);
		$category_type = $this->getTypeCategory();
		return $this->category->updateDataInTable(
									array( $category_type[$type] => $row[$category_type[$type]]+1 ),
									array( 'id_cat'=>$cat)
								);
	}

	public function createPoster( string $nik, int $type, int $cat, string $email, string $msg, string $foto, int $rand, string $cl_ip, string $title) {

		return $this->poster->insertDataToTable( 
								array($nik, $type, $cat, $email, $msg, $foto, $rand, $cl_ip, $title),
								array('name_p', 'type_p', 'cat_p', 'email_p', 'msg_p', 'foto_p1', 'rand_p', 'cl_ip', 'title_p')
							);
	}

	public function changePoster(int $id, string $title, int $cat, int $type, string $name, string $email, $impot, string $msg, string $foto) {
		$args = array(
			'name_p'  => $name,
			'email_p' => $email,
			'type_p'  => $type,
			'cat_p'   => $cat,
			'title_p' => $title,
			'impot'   => $impot,
			'msg_p'   => $msg,
			'foto_p1' => $foto
		);
		return $this->poster->updateDataInTable( $args, array( 'id_poster'=>$id) );
	}

	public function showLineMenuPoster($http,$alt,$title) {
		include ('views/poster/showLineMenuPoster.php');
	}

	public  function showNoPhoto($title) {
		include ('views/poster/showNoPhoto.php');
	}

	public  function showPosterAll($posterItem) {
		print_r($posterItem);
		foreach ($posterItem as $item) {
			include ('views/poster/showPosterAll.php');
		}
	}

	public  function showPhoto($list) {
		$file = 'posterFoto/'.$list["foto_p1"];
		include ('views/poster/showPhoto.php');
	}

	public  function getAllPostersVue($page = 1) {
		$i      = 1;
		$result = $this->poster->selectDataFromTable( array(), 'id_poster', $this->show, 'DESC', false, true, false, true, $page);
		while ($row = $result->fetch()) {
			$postList[$i]['id']       = $row['id_poster'];
			$postList[$i]['title_p']  = $row['title_p'];
			$postList[$i]['type_p']   = $row['type_p'];
			$postList[$i]['date_p']   = $row['date_p'];
			$postList[$i]['foto_p1']  = $row['foto_p1'];
			$postList[$i]['count_p']  = $row['count_p'];
			$i++;
		}
		return $postList ?? [];
	}
}