<?php 
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

include '../../conn.php';

$method = $_POST['method'];

if ($method == 'load_accounts') {
	$row_class_arr = array('modal-trigger', 'modal-trigger bg-primary text-light');
	$row_class = $row_class_arr[0];

	$c = 0;

	$query = "SELECT ID, Username, Name, Role, DateUpdated FROM accounts";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$c++;

			if ($_SESSION['username'] == $row['Username'] && $_SESSION['name'] == $row['Name'] && $_SESSION['role'] == $row['Role']) {
				$row_class = $row_class_arr[1];
			} else {
				$row_class = $row_class_arr[0];
			}

			echo '<tr style="cursor:pointer;" class="'.$row_class.'" data-toggle="modal" data-target="#update_account" data-id="'.$row['ID'].'" data-username="'.$row['Username'].'" data-name="'.$row['Name'].'" data-role="'.$row['Role'].'" onclick="get_accounts_details(this)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.htmlspecialchars($row['Name']).'</td>';
				echo '<td>'.strtoupper($row['Role']).'</td>';
				echo '<td>'.date('Y-m-d h:i A', strtotime($row['DateUpdated'])).'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="4" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'search_accounts') {
	$username = $_POST['username'];
	$name = $_POST['name'];
	$role = $_POST['role'];

	$row_class_arr = array('modal-trigger', 'modal-trigger bg-primary text-light');
	$row_class = $row_class_arr[0];

	$c = 0;

	$query = "SELECT ID, Username, Name, Role, DateUpdated FROM accounts WHERE 1=1";
	$params = array();

	if (!empty($username)) {
		$query .= " AND Username LIKE :username";
		$params[':username'] = $username . "%";
	}
	if (!empty($name)) {
		$query .= " AND Name LIKE :name";
		$params[':name'] = $name . "%";
	}
	if (!empty($role)) {
		$query .= " AND Role = :role";
		$params[':role'] = $role;
	}

	$stmt = $conn->prepare($query);
	foreach($params as $param => $value){
        $stmt->bindValue($param, $value);
    }
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$c++;

			if ($_SESSION['username'] == $row['Username'] && $_SESSION['name'] == $row['Name'] && $_SESSION['role'] == $row['Role']) {
				$row_class = $row_class_arr[1];
			} else {
				$row_class = $row_class_arr[0];
			}

			echo '<tr style="cursor:pointer;" class="'.$row_class.'" data-toggle="modal" data-target="#update_account" data-id="'.$row['ID'].'" data-username="'.$row['Username'].'" data-name="'.$row['Name'].'" data-role="'.$row['Role'].'" onclick="get_accounts_details(this)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.htmlspecialchars($row['Name']).'</td>';
				echo '<td>'.strtoupper($row['Role']).'</td>';
				echo '<td>'.date('Y-m-d h:i A', strtotime($row['DateUpdated'])).'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="4" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'add_account') {
	$name = trim($_POST['name']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$role = trim($_POST['role']);

	$check = "SELECT ID FROM accounts WHERE Username = ?";
	$stmt = $conn->prepare($check);
	$params = array($username);
	$stmt->execute($params);
	if ($stmt->rowCount() > 0) {
		echo 'Already Exist';
	}else{
		$stmt = NULL;
		$query = "INSERT INTO accounts (`Name`, `Username`, `Password`, `Role`) VALUES (?,?,?,?)";
		$stmt = $conn->prepare($query);
		$params = array($name, $username, $password, $role);
		if ($stmt->execute($params)) {
			echo 'success';
		}else{
			echo 'error';
		}
	}
}

if ($method == 'update_account') {
	$id = $_POST['id'];
	$username = trim($_POST['username']);
	$name = trim($_POST['name']);
	$password = trim($_POST['password']);
	$role = trim($_POST['role']);

	$update_username = false;
	$update_password = false;

	$query = "SELECT ID FROM accounts WHERE Username = ?";
	$stmt = $conn->prepare($query);
	$params = array($username);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$update_username = true;
	}

	if (!empty($password)) {
		$update_password = true;
	}

	$stmt = NULL;
    $query = "UPDATE accounts SET Name = :name";
    $params = array(':name' => $name);

    if ($update_username == true) {
        $query .= ", Username = :username";
        $params[':username'] = $username;
    }
    if ($update_password == true) {
        $query .= ", Password = :password";
        $params[':password'] = $password;
    }
    $query .= ", Role = :role WHERE ID = :id";
    $params[':role'] = $role;
    $params[':id'] = $id;

    $stmt = $conn->prepare($query);
    foreach($params as $param => $value){
        $stmt->bindValue($param, $value);
    }
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}

if ($method == 'delete_account') {
	$id = $_POST['id'];

	$query = "DELETE FROM accounts WHERE ID = ?";
	$stmt = $conn->prepare($query);
	$params = array($id);
	if ($stmt->execute($params)) {
		echo 'success';
	}else{
		echo 'error';
	}
}

$conn = NULL;
?>