<?php
$errors = [];

$title = $_POST["title"];
$content = $_POST["content"];

if (empty($title) and empty($content)) {
    $errors[] =
      '記載漏れがあります';
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=contactform; charset=utf8',
    $dbUserName,
    $dbPassword
);

$sql = "INSERT INTO memo(title, content) VALUES (:title, :content)";

$statement = $pdo->prepare($sql);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();

if (empty($errors)) {
  header("Location:index.php");
} else {
  $links = '
  <a href="./create.php">
    <p>メモ画面へ</p>
  </a>
';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>保存確認</title>
</head>
<body>
  <div align="center">
    <?php if (!empty($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error . "\n"; ?></p>
      <?php endforeach; ?>
      <?php echo $links; ?>
    <?php endif; ?>
  </div>
</body>

</html>