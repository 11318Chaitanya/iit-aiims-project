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
    

        $pname_pic = rand(1000, 10000) . "-" . $_FILES["patientpicture"]["name"];
        $tname_pic = $_FILES["patientpicture"]["tmp_name"];
        $upload_dir_pic = "../../assests/patientfile";
        move_uploaded_file($tname_pic, $upload_dir_pic . '/' . $pname_pic);

        $filesArray[] = $pname_pic;
            // Serialize the modified array
        $updatedSerializedData = serialize($filesArray);

        // Update the entry in the database with the new serialized data
        $updateSql = "UPDATE `patientfile` SET `$fileCategory` = '$updatedSerializedData' WHERE `patient_id` = '$patientId'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo "File added Sccessfully";
        } else {
            echo "Error updating the database.";
        }
    } else {
        echo "Error retrieving data from the database.";
    }

?>