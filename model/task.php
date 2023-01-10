<?php
require_once(dirname(__FILE__).'/base.php');

/**
 * タスクモデル
 *
 * @package model
 * @version 1.0.0
 */
class TaskModel extends BaseModel{
	const STATUS_TODO = 0;		// タスクのステータス: 未完了
	const STATUS_DONE = 1;		// タスクのステータス: 完了
	const MAX_BODY = 255;			// タスクの最大byte数

	/**
	 * 全タスクを返却する
	 *
	 * @return array
	 */
	function getAll(){
		$sql = <<<SQL
			SELECT id, body, done, created_at
			FROM tasks
			ORDER BY created_at DESC
		SQL;
		$this->execute($sql);
		return($this->fetchAll());
	}

	/**
	 * タスクを新規作成する
	 *
	 * @param string $body
	 * @return integer
	 */
	function create($body){
		// 文字数チェック
		if( strlen($body) < 1 ){
			throw new Exception('タスク内容が未入力です');
		}
		if( strlen($body) > self::MAX_BODY ){
			throw new Exception('タスク内容の最大バイト数は'.self::MAX_BODY.'です');
		}

		// SQL準備
		$sql = <<<SQL
			INSERT INTO tasks (body, done, created_at, updated_at)
			VALUES (?, ?, now(), now())
		SQL;

		// SQL実行
		$this->execute($sql, [$body, self::STATUS_TODO]);
		return($this->lastInsertId());
	}

	/**
	 * タスクを完了扱いにする
	 *
	 * @param integer $id
	 * @param string $body
	 * @return boolean
	 */
	function done($id){
		// タスクの存在チェック
		if( !$this->_exists($id) ){
			throw new Exception('指定されたIDのタスクが存在しません');
		}

		// SQL準備
		$sql = <<<SQL
			UPDATE tasks
			SET    done=?, updated_at=now()
			WHERE  id = ?
		SQL;

		// SQL実行
		return( $this->execute($sql, [self::STATUS_DONE, $id]) );
	}

	/**
	 * タスクを削除する
	 *
	 * 論理削除ではなく物理削除します。
	 *
	 * @param integer $id
	 * @return boolean
	 */
	function remove($id){
		// タスクの存在チェック
		if( ! $this->_exists($id) ){
			throw new Exception('指定されたIDのタスクが存在しません');
		}

		// SQL準備
		$sql = <<<SQL
			DELETE FROM tasks
			WHERE  id = ?
		SQL;

		// SQL実行
		return( $this->execute($sql, [$id]) );
	}

	/**
	 * タスクをIDで検索する
	 *
	 * @param integer $id
	 * @return void
	 */
	function findById($id){
		// SQL準備
		$sql = <<<SQL
			SELECT *
			FROM   tasks
			WHERE  id = ?
		SQL;

		// SQL実行
		$this->execute($sql, [$id]);
		return($this->fetch());
	}

	/**
	 * タスクが存在するか確認する
	 *
	 * @param integer $id
	 * @return boolean
	 */
	private function _exists($id){
		$record = $this->findById($id);
		return( !empty($record) );
	}
}