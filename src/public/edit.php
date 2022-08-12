
<?php
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO(
  "mysql:host=mysql; dbname=contactform; charset=utf8", 
  $dbUserName, 
  $dbPassword
);

$id = $_GET['id'];
if (empty($id)) {
	header("Location:index.php");
	exit;
}

try{
	$sql = "SELECT * FROM memo WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
} catch (PDOException $e) {
	echo 'Error: ' . $e->getMessage();
	die();
}

if ($memo = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$id = $memo["id"];
	$title = $memo['title'];
	$content = $memo['content'];
} else {
	echo "対象のデータがありません。";
}
?>

<!DOCTYPE html>
<html lang="ja">

<body>
	<form action="edit_done_post.php" method="post">
		<table align="center">
			<input type="hidden" name="id" value="<?php echo $id; ?>" >
			<tr>
				<td><p>タイトル</p></td>
				<td><p><input type="text" name="title" id="title"  value=<?php echo $title; ?>></p></td>
				<td><p>本文</p></td>
				<td><p><input type="text" name="content" id="content"  value=<?php echo $content; ?>></p></td>
				<td><p><input type="submit" value="編集" id="edit" name="edit"></p></td>
			</tr>
		</table>
	</form>
</body>
</html>