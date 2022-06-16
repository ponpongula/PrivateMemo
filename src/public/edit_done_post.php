<?php
$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO(
  "mysql:host=mysql; dbname=contactform; charset=utf8", 
  $dbUserName, 
  $dbPassword
);

$stmt = $pdo->prepare("UPDATE memo SET title = :title, content = :content WHERE id = :id");

$stmt->bindParam( ':id', $id, PDO::PARAM_INT);
$stmt->bindParam( ':title', $title, PDO::PARAM_STR);
$stmt->bindParam( ':content', $content, PDO::PARAM_STR);

$stmt->execute();
header("Location:index.php");
?>