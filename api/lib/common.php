<?php
/**
 * レスポンス
 *
 * @param boolean $status
 * @param mixed $data
 * @return void
 */
function response($status, $data){
	$response = [
		'head' => [
			'status' => $status,
			'time'   => time()
		],
		'data' => $data
	];

	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($response);
}