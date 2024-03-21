<?php

    include "../__dbconnect.php";

    if(isset($_POST['patientname']) && $_POST['patientgender'] && $_POST['patientdob'] && $_POST['patientcontactnum'] && $_POST['patientadharnum'] && $_POST['patientid']){
        $patient_name = $_POST['patientname'];
        $patient_gender = $_POST['patientgender'];
        $patient_dob = $_POST['patientdob'];
        $patient_contact_num = $_POST['patientcontactnum'];
        $patient_adhar_num = $_POST['patientadharnum'];
        $patient_id = $_POST['patientid'];

        $sql = "UPDATE `patientinfo` SET `patient_name` = '$patient_name', `patient_contact_num` = '$patient_contact_num', `patient_gender` = '$patient_gender', `patient_dob` = '$patient_dob', `patient_adhar_num`='$patient_adhar_num' WHERE `patientinfo`.`patient_id` = '$patient_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            if(isset($_FILES["patientpicture"]["name"]) && $_FILES["patientpicture"]["name"] === ''){
                header('location: /project/healthcarepro/main/getpatientdetails.php?patientId='.$patient_id.'');
            }
        }

    }

    if(isset($_FILES["patientpicture"]["name"]) && $_FILES["patientpicture"]["name"] !== ''){
        $sql_f = "SELECT * FROM `patientinfo` WHERE `patient_id` = '$patient_id'";
        $result_f = mysqli_query($conn, $sql_f);
        $row_f = mysqli_fetch_array($result_f);

        $filePath = "../../assests/patientfile/" . $row_f['patient_profile_pic'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $pname_pic = rand(1000, 10000) . "-" . $_FILES["patientpicture"]["name"];
        $tname_pic = $_FILES["patientpicture"]["tmp_name"];
        $upload_dir_pic = "../../assests/patientfile";
        move_uploaded_file($tname_pic, $upload_dir_pic . '/' . $pname_pic);

        $sql = "UPDATE `patientinfo` SET `patient_profile_pic` = '$pname_pic' WHERE `patientinfo`.`patient_id` = '$patient_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location: /project/healthcarepro/main/getpatientdetails.php?patientId='.$patient_id.'');
        }
    }
    

    if(isset($_POST['patientdiagnostictext']) && $_POST['patientmedicationtext'] && $_POST['patientmedicalhistory'] && $_POST['doctorcomment'] && $_POST['patientid']){
        $patient_diagnostic_text = $_POST['patientdiagnostictext'];
        $patient_medication_text = $_POST['patientmedicationtext'];
        $patient_medical_history = $_POST['patientmedicalhistory'];
        $doctor_comment = $_POST['doctorcomment'];
        $patient_id = $_POST['patientid'];

        $sql = "UPDATE `patientinfo` SET `patient_diagnostic_text` = '$patient_diagnostic_text', `patient_medication_text` = '$patient_medication_text', `patient_medical_history` = '$patient_medical_history', `doctor_comment` = '$doctor_comment' WHERE `patientinfo`.`patient_id` = '$patient_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location: /project/healthcarepro/main/getpatientdetails.php?patientId='.$patient_id.'');
        }

    }
    

?>