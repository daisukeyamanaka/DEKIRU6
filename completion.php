<?php
// デーsession_start();タの受け取り
session_start();
$userID = $_SESSION['userID'] ;
$questionID = $_POST['questionID'];
$Ans = $_POST['Ans'];

// 各種項目設定
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO answer ( userNumber, questionID, Ans, deleteFlag) VALUES (:userID, :questionID, :Ans, 0)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
$stmt->bindValue(':questionID', $questionID, PDO::PARAM_INT);
$stmt->bindValue(':Ans', $Ans, PDO::PARAM_STR);

// SQL実行（実行に失敗すると$statusにfalseが返ってくる）
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
  } else {
    //header('Location:Answer.php');
  }
  ?>
<form action="completion.php" method="POST">

	<meta charset="UTF-8" />
	<link
      rel="stylesheet"
      href="sample.css"
    />
  <fieldset>
    <div>
      回答を受付いたしました。
    </div>
    <a href="read.php">一覧画面</a>
  </fieldset>
</form>