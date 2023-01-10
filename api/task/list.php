<?php
/**
 * タスクの一覧を返却する
 *
 * リクエスト例
 *  GET http://example.com/api/task/list.php
 *
 * レスポンス例
 * {
 *  "head": {
 * 	  "status": true,
 * 	  "time": 1234567890
 *  },
 *  "data": [
 * 	  {
 * 		  "id": 1,
 * 		  "body": "xxxxxxxxxxxx",
 *      "statuscd": 1,
 * 		  "created_at": "2016-01-01 00:00:00"
 *    },
 *  ]
 * }
 */
require_once(dirname(__FILE__).'/../../model/task.php');
require_once(dirname(__FILE__).'/../lib/common.php');

//--------------------------------------------------
// DBから取得
//--------------------------------------------------
try{
	$task = new TaskModel();
	$tasks = $task->getAll();
}
catch(PDOException $e){
	// 更新処理は無いのでrollbackは必要無い
	$message = sprintf('DBエラーが発生しました: %s', $e->getMessage());
	response(false, $message);
	exit;
}

//--------------------------------------------------
// レスポンス
//--------------------------------------------------
// 正常終了
response(true, $tasks);