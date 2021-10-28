<?php
// データの受け取り
if (
    !isset($_POST['todo']) || $_POST['todo']=='' ||
    !isset($_POST['deadline']) || $_POST['deadline']==''
  ) {
    exit('ParamError');
  }

$todo = $_POST['todo'];
$deadline = $_POST['deadline'];

// 各種項目設定
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO customer ( todo, deadline, created_at, updated_at) VALUES (:todo, :deadline, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

// SQL実行（実行に失敗すると$statusにfalseが返ってくる）
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
  } else {
    header('Location:read.php');
  }
  