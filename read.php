<?php
include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM customer';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {
        $output .= "
          <tr>
            <td>{$record["deadline"]}</td>
            <td>{$record["todo"]}</td>
            <td>
              <a href='Answer.php?id={$record["id"]}'>☆DEKIRU☆</a>
            </td>
            <td>
              <a href='Answer_list.php?id={$record["id"]}'>回答List</a>
            </td>
          </tr>
        ";
      }
}
?>

<!DOCTYPE html>
<head>
</head>

<body>
  <fieldset>
    <legend>困りごと</legend>
    <table>
      <thead>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
          
      </tbody>
    </table>
  </fieldset>
</body>

</html>