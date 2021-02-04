<?php
include("functions.php");

$search_word = $_GET['searchword'];

$pdo = connect_to_db();

$sql = "SELECT * FROM todo_table WHERE todo LIKE '%{$search_word}%'";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit();
}
