<?php
/**
 * 
 */
class Vote
{

	public function getDBVue()
	{
		require_once ('../components/Db.php');
		$db   = new Db();
		return $db ->getConnectionVue();
	}

	public static function getSQLVote($sql)
	{
		return Db::getConnection() -> query($sql);
	}

	public static function getSQLVoteVue($sql)
	{
		$db  = self::getDBVue();
		return $db -> query($sql);
	}

	public static function getPrepareSQLVue($sql)
	{
		$db  = self::getDBVue();
		return $db -> prepare($sql);
	}

	public static function formSqlVote($atr,$value)
	{
		return " WHERE ".$atr." = ".$value;
	}

	public static function getTxtVote($id)
	{
		$result  = self::getSQLVote("SELECT * FROM vote".self::formSqlVote("category",$id)." ORDER BY countrl DESC");
		while ($row = $result->fetch()) {
			$voteTxt[]=$row;
		}
		return $voteTxt ?? [];
	}

	public static function getVote()
	{
		$result = self::getSQLVote("SELECT * FROM catVote".self::formSqlVote("active",1)." LIMIT 1");
		while ($row = $result->fetch()) {
			$voteList['id']   = $row['idrl'];
			$voteList['name'] = $row['namerl'];
		}
		return $voteList ?? [];;
	}

	public static function getVoteVue()
	{
		$result = self::getSQLVoteVue("SELECT * FROM catVote WHERE active=1 LIMIT 1");
		while ($row = $result->fetch()) {
			$voteList['id']   = $row['idrl'];
			$voteList['name'] = $row['namerl'];
		}
		return $voteList ?? [];;
	}

	public static function getTxtVoteVue($id)
	{
		$result  = self::getSQLVoteVue("SELECT * FROM vote".self::formSqlVote("category",$id)." ORDER BY countrl DESC");
		while ($row = $result->fetch()) {
			$voteTxt[]=$row;
		}
		return $voteTxt ?? [];
	}

	public static function addVote($id)
	{
		return self::getSQLVoteVue("UPDATE vote SET countrl = countrl + 1".self::formSqlVote("id",$id));		
	}
	
	public static function addElVote($name,$cat)
	{
		//$cat    = self::getIntval($cat);
		$sql    = "INSERT INTO vote (msg,category) VALUES(:name, :cat)";
		$result = self::getPrepareSQLVue($sql);
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		$result -> bindParam(':cat',  $cat,  PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function updateVoteVue ($id,$name)
	{
		$result = self::getPrepareSQLVue("UPDATE catVote SET namerl=:name".self::formSqlVote("idrl",$id));
		$result -> bindParam(':name', $name, PDO::PARAM_STR);
		
		return $result -> execute();		
	}

	public static function getVoteVueAd()
	{
		$result = self::getSQLVoteVue("SELECT * FROM catVote");
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']   = $row['idrl'];
			$voteList[$i]['name'] = $row['namerl'];
			$i++;
		}
		return $voteList ?? [];;
	}

	public static function activated($id)
	{
		self::getSQLVote("UPDATE catVote SET active=0".self::formSqlVote("active",1));
		self::getSQLVote("UPDATE catVote SET active=1".self::formSqlVote("idrl",$id));
	}

	public static function getAllVote()
	{
		$result = self::getSQLVote("SELECT * FROM catVote");
		$i      = 1;
		while ($row = $result->fetch()) {
			$voteList[$i]['id']     = $row['idrl'];;
			$voteList[$i]['title']  = $row['namerl'];
			$voteList[$i]['active'] = $row['active'];
			$i++;
		}
		return $voteList ?? [];
	}

	public static function showVote()
	{
		include ('views/layouts/showVote.php');
	}
}
?>