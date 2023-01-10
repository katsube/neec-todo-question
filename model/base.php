<?php
/**
 * BaseModel Class
 *
 * @example
 *    try{
 * 		  $base = new BaseModel();
 *      $base->begin();
 *      $base->execute('INSERT INTO users (name, age) VALUES (?, ?)', ['taro', 20]);
 * 		  $base->commit();
 *    }
 *    catch(PDOException $e){
 *      $base->rollback();
 *      echo $e->getMessage();
 *    }
 */

//--------------------------------------------------
// ライブラリ
//--------------------------------------------------
require(dirname(__FILE__).'/../config/database.php');

class BaseModel{
	protected $dbh;
	protected $sth;

	function __construct(){
		$this->dbh = new PDO(CONFIG_DB_DSN, CONFIG_DB_USER, CONFIG_DB_PASS);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	function execute($sql, $params = [ ]){
		$this->sth = $this->dbh->prepare($sql);
		$ret = $this->sth->execute($params);
		return($ret);
	}

	function fetch($mode=PDO::FETCH_ASSOC){
		return(
			$this->sth->fetch($mode)
		);
	}

	function fetchAll($mode=PDO::FETCH_ASSOC){
		return(
			$this->sth->fetchAll($mode)
		);
	}

	function begin(){
		$this->dbh->beginTransaction();
	}

	function commit(){
		$this->dbh->commit();
	}

	function rollback(){
		$this->dbh->rollback();
	}

	function lastInsertId(){
		return(
			$this->dbh->lastInsertId()
		);
	}
}