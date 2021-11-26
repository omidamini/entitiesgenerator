<?php
/**
 * the namespace
 * @namespace entitiesGenerator
 */
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
namespace entitiesGenerator;
/**
 * the class name
 * @class DB
 */
final class DB 
{
	/**
	 * array that gets database information from @global $infoBdd
	 * @property $infoBdd
	 */
	protected $infoBdd;
	function __construct()
	{
		/** @global $infoBdd */
		global $infoBdd;
		$this->infoBdd =  $infoBdd;
		/**pgsql connect*/
		if($this->infoBdd['type'] == 'pgsql')
		{
			$this->bddCon = pg_connect("host=".$this->infoBdd ['host']." port=".$this->infoBdd ['port']." dbname=".$this->infoBdd ['dbname']." user=".$this->infoBdd ['user']." password=".$this->infoBdd ['pass']."");
			if (!$this->bddCon) 
			{
				die ("impossible de se connecter à la base de données.\n");	
			}
		}
		/**mysql connect*/
		else
		{
			$this->bddCon = mysqli_connect($this->infoBdd ['host'], $this->infoBdd ['user'], $this->infoBdd ['pass'], $this->infoBdd ['dbname']);
			if (!$this->bddCon) 
			{
				die ("impossible de se connecter à la base de données.\n". mysqli_error($this->bdCon));	
			}
		}
		
		
		
	}

	function __destruct(){
		
		if($this->infoBdd['type'] == 'pgsql')
		{
			pg_close($this->bddCon);
		}
		else
		{
			mysqli_close($this->bddCon);
		}
			
	}
/** @method selectTables() gets all table names */
	function selectTables()
	{

			$myQuery = "SELECT tablename FROM pg_tables WHERE tablename NOT LIKE 'pg_%' AND tablename NOT LIKE 'sql_%'";
			
			if($this->infoBdd['type'] == 'pgsql')
			{
				$results = pg_query($this->bddCon, $myQuery);
			}
			else
			{
				$myQuery = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = '".$this->infoBdd['dbname']."'";
				$results = mysqli_query($this->bddCon, $myQuery);
			}
			return $this->fetch_query($results);
	}
	/** @param $tablename
	 * @method selecColumns() gets all column names 
	 * */
	function selecColumns($tablename)
	{
			$myQuery = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$tablename."'";
			
			if($this->infoBdd['type'] == 'pgsql')
			{
				$results = pg_query($this->bddCon, $myQuery);
			}
			else
			{
				$results = mysqli_query($this->bddCon, $myQuery);
			}
			
			
			return $this->fetch_query($results);
	}
	function selectTablePrimaryKey($tablename)
	{
		$myQuery = "SELECT conrelid::regclass AS table_name, 
		conname AS primary_key, 
		pg_get_constraintdef(oid) 
		FROM   pg_constraint 
		WHERE  contype = 'p' 
		AND    connamespace = 'public'::regnamespace  
		AND    conrelid::regclass::text = 'inclure' 
		ORDER  BY conrelid::regclass::text, contype DESC; ";
	}
	/**
	 * @param $results
	 * @method fetch_query()
	 */
	function fetch_query($results)
	{
		
		$columnNamesArray = array();
		if($this->infoBdd['type'] == 'pgsql')
		{
			if(pg_num_rows($results) > 0)
			{
				while( $row = pg_fetch_assoc($results))
				{
					$columnNamesArray[] = isset($row['column_name'])?$row['column_name']:$row['tablename'];
				}
			}
			
		}
		else
		{
			if(mysqli_num_rows($results)>0)
			{
				while( $row = mysqli_fetch_assoc($results))
				{
					$columnNamesArray[] = isset($row['column_name'])?$row['column_name']:$row['TABLE_NAME'];
				}
			}
		}
		return $columnNamesArray;
	}

}

?>
	
