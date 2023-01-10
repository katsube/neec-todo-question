<?php
/**
 * タスクを新規に作成する
 *
 * リクエスト例
 *   POST http://example.com/api/task/create.php
 *   body=xxxxxxxxxxxx
 *
 * レスポンス例
 *   {
 * 	   "head": {
 * 	     "status": true,
 * 	     "time": 1234567890
 * 	   },
 * 	   "data": {
 * 	     "id": 1
 * 	   }
 *   }
 */

require_once(dirname(__FILE__).'/../../model/task.php');
require_once(dirname(__FILE__).'/../lib/common.php');

//--------------------------------------------------
// 引数を取得
//--------------------------------------------------
$body = empty($_POST['body'])? null: $_POST['body'];

// 値をチェック（バリデーション）
if( $body === null ){
	response(false, 'パラメーター body は必須項目です');
	exit;
}

//--------------------------------------------------
// DBに挿入する
//--------------------------------------------------
try{
	$task = new TaskModel();
	$id = $task->create($body);
}
catch(PDOException $e){
	response(false, 'DBエラーが発生しました');		// 更新処理は無いのでrollbackは必要無い
	exit;
}

//--------------------------------------------------
// レスポンス
//--------------------------------------------------
// 正常終了
response(true, [
	'id' => $id		// 新規作成したタスクのIDを返却
]);
