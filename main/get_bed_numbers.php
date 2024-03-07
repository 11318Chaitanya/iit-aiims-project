<?php
// Include database connection code if necessary
include "../partials/__dbconnect.php";

session_start();

$user_id = (int)$_SESSION['sno'];

// getting hospital id according to user id 
if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
    $sql = "SELECT * FROM `hospitaldata` WHERE `doctor_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $hospital_id = $row['hospital_id'];
} else{
    $sql = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $hospital_id = $row['hospital_id'];
}

// Retrieve selected bed type from AJAX request
$bedType = $_GET['bedType'];

// Query available bed numbers based on selected bed type
$sql_no = "SELECT * FROM `bedinfo` WHERE `bed_type`='$bedType' AND `bed_availibility`='AV' AND `hospital_id`='$hospital_id'";
$result_no = mysqli_query($conn, $sql_no);
$options = "<option value='any'>Any</option>"; // Initialize options variable with default option
while($row_no = mysqli_fetch_assoc($result_no)){
    $options .= "<option value='{$row_no['bed_num']}'>{$row_no['bed_num']}</option>"; // Append each bed number option
}

// Output options for the second dropdown
echo $options;
?>
