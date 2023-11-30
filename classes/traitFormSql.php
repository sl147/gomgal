<?php
/**
 * 
 */
//namespace classes;

trait traitFormSql
{
	public function formSql($atr,$value)
	{
		return " WHERE ".$atr." = '".$value."'";
	}
}
?>