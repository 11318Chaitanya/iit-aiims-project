<?php
    $fileName = $_GET['fileName'];
    $fileCategory = $_GET['fileCategory'];

    $sql = "SELECT `$fileCategory` FROM `patientfile` WHERE `patient_id` = '$patientId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    

?>