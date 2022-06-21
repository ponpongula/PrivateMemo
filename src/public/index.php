<?php
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO(
  "mysql:host=mysql; dbname=contactform; charset=utf8", 
  $dbUserName, 
  $dbPassword
);

// $sql = "SELECT * FROM memo";
// $statement = $pdo->prepare($sql);
// $statement->execute();
// $memo = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['search'])) {
  $title = '%' . $_GET['search'] . '%';
  $content = '%' . $_GET['search'] . '%';
} else {
  $title = '%%';
  $content = '%%';
}

$sql = "SELECT * FROM memo WHERE title LIKE :title OR content LIKE :content ORDER BY id $direction";
$statement = $pdo->prepare($sql);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();
$memo = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
 <title>メモ一覧</title>
</head>

<body>
  <form action="index.php" method="get">
    <input name="search" type="text" value="<?php echo $_GET['search'] ??
                ''; ?>" placeholder="キーワードを入力" />
    <input type="submit" name="submit" value="検索">
    <a href = "create.php"><p>メモ追加</p></a>
  </form>

  <table border="1" align="center" width="1500">
    <tr>
      <th>タイトル</th>
      <th>内容</th>
      <th>作成日時</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
    <?php foreach ($memo as $value) : ?>
      <form action ="index.php" method="post">
        <input type="hidden" name ="id" value = "<?php echo $value['id']  ?>"></input>
        <tr>
            <td><p><?php echo $value['title']  ?></p></td>
            <td><p><?php echo $value['content'] ?></p></td>
            <td><p><?php echo $value['created_at'] ?></p></td>
            <td><p><a href = "edit.php?id=<?php echo $value['id']; ?>">編集</p></td>    
            <td><p><a href = "delete.php?id=<?php echo $value['id']; ?>">削除</p></td>  
        </tr>
        </form>
    <?php endforeach; ?>
  </table>
</body>
</html>