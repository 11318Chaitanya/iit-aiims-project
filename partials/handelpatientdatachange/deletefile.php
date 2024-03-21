<?php

include "../__dbconnect.php";

    $fileName = $_GET['fileName'];
    $fileCategory = $_GET['fileCategory'];
    $patientId = $_GET['patientId'];

    echo $fileName;
    echo $fileCategory;
    echo $patientId;

    $sql = "SELECT * FROM `patientfile` WHERE `patient_id` = '$patientId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    echo "$row[$fileCategory]";

    if ($row && isset($row[$fileCategory])) {
        // Unserialize the data
        $filesArray = unserialize($row[$fileCategory]);
    
        // Check if the file exists in the array
        $key = array_search($fileName, $filesArray);
        if ($key !== false) {
            // Remove the file from the array
            unset($filesArray[$key]);
    
            // Construct the file path
            $filePath = "../assests/patientfile/" . $fileName;
    
            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }
    
            // Serialize the modified array
            $updatedSerializedData = serialize($filesArray);
    
            // Update the entry in the database with the new serialized data
            $updateSql = "UPDATE `patientfile` SET `$fileCategory` = '$updatedSerializedData' WHERE `patient_id` = '$patientId'";
            $updateResult = mysqli_query($conn, $updateSql);
    
            if ($updateResult) {
                echo "YES";
            } else {
                echo "Error updating the database.";
            }
        } else {
            echo "File '$fileName' not found in category '$fileCategory'.";
        }
    } else {
        echo "Error retrieving data from the database.";
    }

?>