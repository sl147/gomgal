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
		return $voteList;
	}

	public static function getVoteVue()
	{
		$result = self::getSQLVoteVue("SELECT * FROM catVote WHERE active=1 LIMIT 1");
		while ($row = $result->fetch()) {
			$voteList['id']   = $row['idrl'];
			$voteList['name'] = $row['namerl'];
		}
		return $voteList;
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
}
?>