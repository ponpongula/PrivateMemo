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
$id = $_GET['id'];

if (empty($id)) {
  header("Location: main.php");
  exit;
}

try{
	$sql = "DELETE FROM memo WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
  header("Location: index.php");
} catch (PDOException $e) {
	echo 'Error: ' . $e->getMessage();
	die();
}
?>
