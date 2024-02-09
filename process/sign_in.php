<?php
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

require('conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

/*$query = "SELECT Username, Name, Role FROM Accounts WHERE Username = BINARY convert(:username using utf8mb4) collate utf8mb4_bin AND Password = BINARY convert(:password using utf8mb4) collate utf8mb4_bin";*/
$query = "CALL `SignIn`(:username, :password)";
$stmt = $conn -> prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
if ($stmt -> execute()) {
	if ($stmt -> rowCount() > 0) {
		while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
			$_SESSION['username'] = $row['Username'];
			$_SESSION['name'] = $row['Name'];
			$_SESSION['role'] = $row['Role'];
		}
		echo 'success';
	} else {
		echo 'failed';
	}
} else {
	echo $stmt -> errorInfo();
}
?>