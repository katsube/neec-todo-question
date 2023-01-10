<?php
/*
 * タスクを削除する
 *
 * リクエスト例
 *  POST http://example.com/api/task/remove.php
 *  id=1
 *
 * レスポンス例
 * {
 *  "head": {
 * 		"status": true,
 * 		"time": 1234567890
 * 	},
 * 	"data": true
 * }
 */

require_once(dirname(__FILE__).'/../../model/task.php');
require_once(dirname(__FILE__).'/../lib/common.php');

//--------------------------------------------------
// 引数を取得
//--------------------------------------------------
$id = empty($_POST['id'])? null: $_POST['id'];

// 値をチェック（バリデーション）
if( $id === null ){
	response(false, 'パラメーター id は必須項目です');
	exit;
}

//--------------------------------------------------
// DBを更新する
//--------------------------------------------------
try{
	$task = new TaskModel();
	$task->remove($id);
}
catch(PDOException $e){
	response(false, 'DBエラーが発生しました');
	exit;
}

//--------------------------------------------------
// レスポンス
//--------------------------------------------------
// 正常終了
response(true, true);