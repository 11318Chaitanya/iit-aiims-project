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
$options = ''; // Initialize options variable
if(isset($_GET['bedNum']) && $_GET['bedNum'] !== '') {
    $options = '<option value="'.$_GET['bedNum'].'">'.$_GET['bedNum'].'</option>'; // Set the default option
    $sql_no = "SELECT * FROM `bedinfo` WHERE `bed_type`='$bedType' AND `bed_availibility`='Available' AND `hospital_id`='$hospital_id' AND `bed_num` <> '".$_GET['bedNum']."'";
}
else{
    $sql_no = "SELECT * FROM `bedinfo` WHERE `bed_type`='$bedType' AND `bed_availibility`='Available' AND `hospital_id`='$hospital_id'";
}
$result_no = mysqli_query($conn, $sql_no);
while($row_no = mysqli_fetch_assoc($result_no)){
    $options .= "<option value='{$row_no['bed_num']}'>{$row_no['bed_num']}</option>"; // Append each bed number option
}

// Output options for the second dropdown
echo $options;
?>
