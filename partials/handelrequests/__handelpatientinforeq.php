<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "../__dbconnect.php";

        session_start();
        $user_id_f = (int)$_SESSION['sno'];

        $hospital_id = $_POST['hospital_id'];
        $patient_id = $_POST['patient_id'];
        $request_description = $_POST['request_description'];

        $sql = "SELECT * FROM `hospitalinfo` WHERE `hospital_id` = '$hospital_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_id_t = $row['user_id'];

        $sql_r = "INSERT INTO `patientinforeq` (`req_from`, `req_to`, `patient_id`,`req_description`, `req_status`, `tstamp`) VALUES ('$user_id_f', '$user_id_t','$patient_id','$request_description', 'Pending', current_timestamp())";
        $result_r = mysqli_query($conn, $sql_r);
        if($result_r){
            header('location: /project/healthcarepro/main/requestportal/requestpatientinfo.php?pirs=true');
        }else{
            header('location: /project/healthcarepro/main/requestportal/requestpatientinfo.php?pirs=false');
        }
    }
?>
