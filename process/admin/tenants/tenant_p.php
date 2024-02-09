<?php 
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

include '../../conn.php';

$method = $_POST['method'];

function count_tenants($search_arr, $conn) {
	$query = "SELECT count(ID) AS total FROM tenants WHERE 1=1";
	$params = array();

	if (!empty($search_arr['tenant_id'])) {
		$query .= " AND TenantID LIKE :tenant_id";
		$params[':tenant_id'] = "%" . $search_arr['tenant_id'] . "%";
	}
	if (!empty($search_arr['last_name'])) {
		$query .= " AND LastName LIKE '".$search_arr['last_name']."%'";
		$params[':last_name'] = $search_arr['last_name'] . "%";
	}
	if (!empty($search_arr['active'])) {
		$query .= " AND Active = :active";
		$params[':active'] = $search_arr['active'];
	}
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	foreach($params as $param => $value){
        $stmt->bindValue($param, $value);
    }
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$total = $row['total'];
		}
	}else{
		$total = 0;
	}
	return $total;
}

if ($method == 'count_tenants') {
	$tenant_id = $_POST['tenant_id'];
	$last_name = $_POST['last_name'];
	$active = $_POST['active'];

	$search_arr = array(
		"tenant_id" => $tenant_id,
		"last_name" => $last_name,
		"active" => $active
	);

	echo count_tenants($search_arr, $conn);
}

if ($method == 'tenants_last_page') {
	$tenant_id = $_POST['tenant_id'];
	$last_name = $_POST['last_name'];
	$active = $_POST['active'];

	$search_arr = array(
		"tenant_id" => $tenant_id,
		"last_name" => $last_name,
		"active" => $active
	);

	$results_per_page = 10;

	$number_of_result = intval(count_tenants($search_arr, $conn));

	//determine the total number of pages available  
	$number_of_page = ceil($number_of_result / $results_per_page);

	echo $number_of_page;

}

if ($method == 'search_tenants') {
	$tenant_id = $_POST['tenant_id'];
	$last_name = $_POST['last_name'];
	$active = $_POST['active'];

	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;

	//determine the sql LIMIT starting number for the results on the displaying page
	$page_first_result = ($current_page-1) * $results_per_page;

	$c = $page_first_result;

	$query = "SELECT * FROM tenants WHERE 1=1";
	$params = array();

	if (!empty($tenant_id)) {
		$query .= " AND TenantID LIKE :tenant_id";
		$params[':tenant_id'] = "%". $tenant_id . "%";
	}
	if (!empty($last_name)) {
		$query .= " AND LastName LIKE :last_name";
		$params[':last_name'] = $last_name . "%";
	}
	if (!empty($active)) {
		$query .= " AND Active = :active";
		$params[':active'] = $active;
	}

	$query .= " LIMIT ".$page_first_result.", ".$results_per_page;

	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	foreach($params as $param => $value){
        $stmt->bindValue($param, $value);
    }
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$c++;
            $full_name = $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'];
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_tenant"';
            echo ' data-id="'.$row['ID'];
            echo '" data-tenant_id="'.$row['TenantID'];
            echo '" data-last_name="'.$row['LastName'];
            echo '" data-first_name="'.$row['FirstName'];
            echo '" data-middle_name="'.$row['MiddleName'];
            echo '" data-address="'.$row['Address'];
            echo '" data-num_of_tenants="'.$row['NumOfTenants'];
            echo '" data-contact_number="'.$row['ContactNumber'];
            echo '" data-occupation="'.$row['Occupation'];
            echo '" data-company="'.$row['Company'];
            echo '" data-work_address="'.$row['WorkAddress'];
            echo '" data-active="'.$row['Active'];
            echo '" onclick="get_tenants_details(this)">';
            
            echo '<td>'.$c.'</td>';
            echo '<td>'.$row['TenantID'].'</td>';
            echo '<td>'.htmlspecialchars($full_name).'</td>';
            echo '<td>'.$row['NumOfTenants'].'</td>';
            echo '<td>'.$row['DateUpdated'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="5" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'add_tenant') {
	$tenant_id = "T00000001";
	$recent_tenant_id = "";
	$last_name = trim($_POST['last_name']);
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $address = trim($_POST['address']);
    $num_of_tenants = trim($_POST['num_of_tenants']);
    $contact_number = trim($_POST['contact_number']);
    $occupation = trim($_POST['occupation']);
    $company = trim($_POST['company']);
    $work_address = trim($_POST['work_address']);

	$check = "SELECT TenantID FROM tenants ORDER BY ID DESC LIMIT 1";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $row){
			$recent_tenant_id = $row['TenantID'];
		}

		$recent_tenant_id_arr = explode('-', $recent_tenant_id);
		$tenant_number = intval($recent_tenant_id_arr[1]);
		$tenant_number++;
		// Format the number with leading zeros
		$formattedNumber = sprintf('%09d', $tenant_number);
		// Concatenate "Room-" with the formatted number
		$tenant_id = "T" . $formattedNumber;
	}

	$stmt = NULL;
	$query = "INSERT INTO tenants (`TenantID`, `LastName`, `FirstName`, `MiddleName`, `Address`, `NumOfTenants`, `ContactNumber`, `Occupation`, `Company`, `WorkAddress`) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$params = array($tenant_id, $last_name, $first_name, $middle_name, $address, $num_of_tenants, $contact_number, $occupation, $company, $work_address);
	if ($stmt->execute($params)) {
		echo 'success';
	}else{
		echo 'error';
	}
}

if ($method == 'update_tenant') {
	$id = $_POST['id'];
	$last_name = trim($_POST['last_name']);
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $address = trim($_POST['address']);
    $num_of_tenants = trim($_POST['num_of_tenants']);
    $contact_number = trim($_POST['contact_number']);
    $occupation = trim($_POST['occupation']);
    $company = trim($_POST['company']);
    $work_address = trim($_POST['work_address']);

	$query = "UPDATE tenants SET LastName = ?, FirstName = ?, MiddleName = ?, Address = ?, NumOfTenants = ?, ContactNumber = ?, Occupation = ?, Company = ?, WorkAddress = ? WHERE ID = ?";
	$stmt = $conn->prepare($query);
	$params = array($last_name, $first_name, $middle_name, $address, $num_of_tenants, $contact_number, $occupation, $company, $work_address, $id);
	if ($stmt->execute($params)) {
		echo 'success';
	}else{
		echo 'error';
	}
}

if ($method == 'delete_tenant') {
	$id = $_POST['id'];

	$query = "DELETE FROM tenants WHERE ID = ?";
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