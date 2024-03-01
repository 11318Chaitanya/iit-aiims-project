<?php    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include "../__dbconnect.php";

        session_start();

        $user_id = (int)$_SESSION['sno'];

        $hospitalName = $_POST['hospitalname'];
        $hospitalAddress = $_POST['hospitaladdress'];
        $hospitalContactNum = $_POST['hospitalcontactnum'];
        $hospitalId = $_POST['hospitalid'];
        
        // for uploading image

        $himage = rand(1000, 10000) . "-" . $_FILES["hospitalimg"]["name"];
        $h_tname_img = $_FILES["hospitalimg"]["tmp_name"];
        $h_upload_dir_img = "../../assests/hospitalimage";
        move_uploaded_file($h_tname_img, $h_upload_dir_img . '/' . $himage);

        // for uploading file

        $hdoc = rand(1000, 10000) . "-" . $_FILES["hospitaldoc"]["name"];
        $h_tname_doc = $_FILES["hospitaldoc"]["tmp_name"];
        $h_upload_dir_doc = "../../assests/hospitaldocument";
        move_uploaded_file($h_tname_doc, $h_upload_dir_doc . '/' . $hdoc);

        $sql_hi = "INSERT INTO `hospitalinfo` (`hospital_name`, `hospital_address`, `hospital_contact_num`, `hospital_id`, `hospital_img`, `hospital_doc`, `user_id`, `tstamp`) VALUES ('$hospitalName', '$hospitalAddress', '$hospitalContactNum', '$hospitalId', '$himage', '$hdoc', '$user_id', current_timestamp())";

        $result_hi= mysqli_query($conn, $sql_hi);

        // for updating user register_progress

        if($result_hi){
            $sql = "UPDATE `logusers` SET `register_progress` = 'CO' WHERE `logusers`.`sno` = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if($result){
                header('location: /project/healthcarepro/onboarding/registrationcomplete.php');
            }
        }
        
    }
?>
