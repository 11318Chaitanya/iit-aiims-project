<?php
// Include database connection code if necessary
include "../../partials/__dbconnect.php";

// Retrieve selected bed type from AJAX request
$hospitalId = $_GET['hospitalId'];

// Query available bed numbers based on selected bed type
$options = ''; // Initialize options variable

$sql = "SELECT DISTINCT bed_type FROM `bedinfo` WHERE `hospital_id` = '$hospitalId' AND `bed_availibility` = 'Available'";
$result= mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $options .= "<option value='{$row['bed_type']}'>{$row['bed_type']}</option>"; // Append each bed number option
}

// Output options for the second dropdown
echo $options;
?>
