<?php
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

include '../../conn.php';

$method = $_POST['method'];

function get_default_amount($conn)
{
	$data = array();
	$query = "SELECT * FROM amounts";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $row) {
			$data[$row["AmountName"]] = $row["Amount"];
		}
	}
	return $data;
}

function count_rooms($search_arr, $conn)
{
	$query = "SELECT count(ID) AS total FROM rooms WHERE 1=1";
	$params = array();

	if (!empty($search_arr['room_id'])) {
		$query .= " AND RoomID LIKE :room_id";
		$params[':room_id'] = "%" . $search_arr['room_id'] . "%";
	}
	if (!empty($search_arr['room_type'])) {
		$query .= " AND RoomType LIKE '" . $search_arr['room_type'] . "%'";
		$params[':room_type'] = $search_arr['room_type'] . "%";
	}
	if (!empty($search_arr['room_rent'])) {
		$query .= " AND RoomRent LIKE :room_rent";
		$params[':room_rent'] = $search_arr['room_rent'] . "%";
	}
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	foreach ($params as $param => $value) {
		$stmt->bindValue($param, $value);
	}
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $row) {
			$total = $row['total'];
		}
	} else {
		$total = 0;
	}
	return $total;
}

if ($method == 'count_rooms') {
	$room_id = $_POST['room_id'];
	$room_type = $_POST['room_type'];
	$room_rent = $_POST['room_rent'];

	$search_arr = array(
		"room_id" => $room_id,
		"room_type" => $room_type,
		"room_rent" => $room_rent
	);

	echo count_rooms($search_arr, $conn);
}

if ($method == 'rooms_last_page') {
	$room_id = $_POST['room_id'];
	$room_type = $_POST['room_type'];
	$room_rent = $_POST['room_rent'];

	$search_arr = array(
		"room_id" => $room_id,
		"room_type" => $room_type,
		"room_rent" => $room_rent
	);

	$results_per_page = 10;

	$number_of_result = intval(count_rooms($search_arr, $conn));

	//determine the total number of pages available  
	$number_of_page = ceil($number_of_result / $results_per_page);

	echo $number_of_page;

}

if ($method == 'search_rooms') {
	$room_id = $_POST['room_id'];
	$room_type = $_POST['room_type'];
	$room_rent = $_POST['room_rent'];

	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;

	//determine the sql LIMIT starting number for the results on the displaying page
	$page_first_result = ($current_page - 1) * $results_per_page;

	$c = $page_first_result;

	$query = "SELECT * FROM rooms WHERE 1=1";
	$params = array();

	if (!empty($room_id)) {
		$query .= " AND RoomID LIKE :room_id";
		$params[':room_id'] = "%" . $room_id . "%";
	}
	if (!empty($room_type)) {
		$query .= " AND RoomType LIKE :room_type";
		$params[':room_type'] = $room_type . "%";
	}
	if (!empty($room_rent)) {
		$query .= " AND RoomRent LIKE :room_rent";
		$params[':room_rent'] = $room_rent . "%";
	}

	$query .= " LIMIT " . $page_first_result . ", " . $results_per_page;

	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	foreach ($params as $param => $value) {
		$stmt->bindValue($param, $value);
	}
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $row) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_room"';
			echo ' data-id="' . $row['ID'];
			echo '" data-room_id="' . $row['RoomID'];
			echo '" data-room_type="' . $row['RoomType'];
			echo '" data-room_rent="' . $row['RoomRent'];
			echo '" data-room_description="' . $row['RoomDescription'];
			echo '" data-amount_per_kw_electric="' . $row['AmountPerKwElectric'];
			echo '" data-amount_per_head_water="' . $row['AmountPerHeadWater'];
			echo '" data-occupied="' . $row['Occupied'];
			echo '" onclick="get_rooms_details(this)">';

			echo '<td>' . $c . '</td>';
			echo '<td>' . $row['RoomID'] . '</td>';
			echo '<td>' . $row['RoomType'] . '</td>';
			echo '<td>' . $row['RoomRent'] . '</td>';
			echo '<td>' . $row['DateUpdated'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="5" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'add_room') {
	$room_id = "Room-001";
	$recent_room_id = "";
	$room_type = trim($_POST['room_type']);
	$room_description = trim($_POST['room_description']);
	$room_rent = trim($_POST['room_rent']);

	$amounts_arr = get_default_amount($conn);
	$amount_per_kw_electric = $amounts_arr['AmountPerKwElectric'];
	$amount_per_head_water = $amounts_arr['AmountPerHeadWater'];

	$check = "SELECT RoomID FROM rooms ORDER BY ID DESC LIMIT 1";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $row) {
			$recent_room_id = $row['RoomID'];
		}

		$recent_room_id_arr = explode('-', $recent_room_id);
		$room_number = intval($recent_room_id_arr[1]);
		$room_number++;
		// Format the number with leading zeros
		$formattedNumber = sprintf('%03d', $room_number);
		// Concatenate "Room-" with the formatted number
		$room_id = "Room-" . $formattedNumber;
	}

	$stmt = NULL;
	$query = "INSERT INTO rooms (`RoomID`, `RoomType`, `RoomDescription`, `RoomRent`, `AmountPerKwElectric`, `AmountPerHeadWater`) VALUES (?,?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$params = array($room_id, $room_type, $room_description, $room_rent, $amount_per_kw_electric, $amount_per_head_water);
	if ($stmt->execute($params)) {
		echo 'success';
	} else {
		echo 'error';
	}
}

if ($method == 'update_room') {
	$id = $_POST['id'];
	$room_type = trim($_POST['room_type']);
	$room_description = trim($_POST['room_description']);
	$room_rent = trim($_POST['room_rent']);
	$amount_per_kw_electric = trim($_POST['amount_per_kw_electric']);
	$amount_per_head_water = trim($_POST['amount_per_head_water']);

	$query = "UPDATE rooms SET RoomType = ?, RoomDescription = ?, RoomRent = ?, AmountPerKwElectric = ?, AmountPerHeadWater = ? WHERE ID = ?";
	$stmt = $conn->prepare($query);
	$params = array($room_type, $room_description, $room_rent, $amount_per_kw_electric, $amount_per_head_water, $id);
	if ($stmt->execute($params)) {
		echo 'success';
	} else {
		echo 'error';
	}
}

if ($method == 'delete_room') {
	$id = $_POST['id'];

	$query = "DELETE FROM rooms WHERE ID = ?";
	$stmt = $conn->prepare($query);
	$params = array($id);
	if ($stmt->execute($params)) {
		echo 'success';
	} else {
		echo 'error';
	}
}

$conn = NULL;
?>