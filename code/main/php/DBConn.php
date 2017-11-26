<?php 
	class dbconn{

		var $m_dbh;

		function __construct($dbname) {

			if(empty($dbname)){
				$dbname = constant("db_name");
			}
			
			$dsn = constant("db_system").':host='.constant("db_host").';dbname='.$dbname;
			$Account = constant("db_admin");
			$Password = constant("db_passwd");
			try {
		    	$this->m_dbh = new PDO($dsn, $Account, $Password);
			} catch (Exception $e) {
		    	return $e->getMessage();
			}
			$this->m_dbh->exec("SET NAMES 'utf8mb4'");

		}

		//查詢SQL資料函數
		//輸入： $sql:SQL指令 $params:參數
		//輸出： 資料陣列
		function selectData($sql,$params) {
			try{	
		    	$SQLAction = $this->m_dbh -> prepare($sql);
				$SQLAction -> execute($params);
				$arr = $SQLAction->fetchAll();
				return $arr;
			} 
			catch(PDOException $e){
				return $e->getMessage();
			}
		}

		//插入SQL資料函數
		//輸入： $sql:SQL指令 $params:參數
		function insertData($sql,$params){
			try
			{	
		    	$SQLAction = $this->m_dbh->prepare($sql);
				if( !($SQLAction->execute($params)))
					return 0;
				return $this->m_dbh->lastInsertId();
			} 
			catch(PDOException $e)
			{
				return $e->getMessage(); 
			}
		}

		//更新SQL資料函數
		//輸入： $sql:SQL指令 $params:參數
		function updateData($sql,$params)
		{
			try
			{	
		    	$SQLAction = $this->m_dbh -> prepare($sql);
				return $SQLAction -> execute($params);
			} 
			catch(PDOException $e)
			{
				return $e->getMessage(); 
			}
		}

		//移除SQL資料函數
		//輸入： $sql:SQL指令 $params:參數
		function deleteData($sql,$params)
		{
			try
			{	
		    	$SQLAction = $this->m_dbh -> prepare($sql);
				$SQLAction -> execute($params);
			} 
			catch(PDOException $e)
			{
				return $e->getMessage(); 
			}
		}


	}
?>