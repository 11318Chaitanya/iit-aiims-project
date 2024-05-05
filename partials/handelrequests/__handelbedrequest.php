<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "../__dbconnect.php";

        session_start();
        $user_id_f = (int)$_SESSION['sno'];

        $hospital_id = $_POST['hospital_id'];
        $bed_type = $_POST['bed_type'];
        $patient_id = $_POST['patient_id'];
        $date_for_admission = $_POST['date_for_admission'];
        $request_description = $_POST['request_description'];

        echo "$date_for_admission";

        $sql = "SELECT * FROM `hospitalinfo` WHERE `hospital_id` = '$hospital_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_id_t = $row['user_id'];

        $sql_r = "INSERT INTO `bedrequest` (`req_from`, `req_to`, `bed_type`, `patient_id`, `date_for_admission`, `req_description`, `req_status`, `tstamp`) VALUES ('$user_id_f', '$user_id_t', '$bed_type', '$patient_id', '$date_for_admission', '$request_description', 'Pending', current_timestamp())";
        $result_r = mysqli_query($conn, $sql_r);
        if($result_r){
            header('location: /project/healthcarepro/main/requestportal/requestbed.php?bedRequestSuccess=true');
        }else{
            header('location: /project/healthcarepro/main/requestportal/requestbed.php?bedRequestSuccess=false');
        }
    }
?>
