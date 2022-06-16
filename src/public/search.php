<?php
$dbUserName = "root";
$dbPassword = "password";
$options = [];
$pdo = new PDO(
  "mysql:host=mysql; dbname=contactform; charset=utf8", 
  $dbUserName, 
  $dbPassword,
  $options
);

if ((@$_POST["title"] != "") OR (@$_POST["content"] != "")) {
  $stmt = $pdo->query("SELECT * FROM memo WHERE title LIKE '%".$_POST["title"]."%' OR content LIKE '%".$_POST["content"]."%'");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
 <title>メモ一覧</title>
</head>

<body>
  <a href = "create.php"><p>メモ追加</p></a>
  <a href = "index.php"><p>一覧へ</p></a>
  <table border="1" align="center" width="1500">
      <tr>
        <th>タイトル</th>
        <th>内容</th>
        <th>作成日時</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($stmt as $search) : ?>
        <tr>
            <td><p><?php echo $search[1] ?></p></td>
            <td><p><?php echo $search[2] ?></p></td>
            <td><p><?php echo $search[3] ?></p></td>
            <td><p><a href = "edit.php?id=<?php echo $value['id']; ?>">編集</p></td>    
            <td><p><a href = "delete.php?id=<?php echo $value['id']; ?>">削除</p></td>  
        </tr>
      <?php endforeach; ?>
  </table>
</body>
</html>