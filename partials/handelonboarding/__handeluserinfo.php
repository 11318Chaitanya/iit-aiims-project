<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "../__dbconnect.php";

        session_start();

        $user_id = (int)$_SESSION['sno'];

        $username = $_POST['username'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contactNum = $_POST['mobileNum'];
        $adharNum = $_POST['adharNum'];
        
        // for uploading image

        $pname = rand(1000, 10000) . "-" . $_FILES["userpicture"]["name"];
        $tname = $_FILES["userpicture"]["tmp_name"];
        $upload_dir = "../../assests/userimage";
        move_uploaded_file($tname, $upload_dir . '/' . $pname);

        $sql_ui = "INSERT INTO `userinfo` (`username`, `dob`, `gender`, `contact_num`, `adharcard_num`, `profile_pic`, `user_id`, `tstamp`) VALUES ('$username', '$dob', '$gender', '$contactNum', '$adharNum', '$pname', '$user_id', current_timestamp())";

        $result_ui= mysqli_query($conn, $sql_ui);

        // for updating user register_progress

        if($result_ui){
            $sql = "UPDATE `logusers` SET `register_progress` = 'HI' WHERE `logusers`.`sno` = 4";
            $result = mysqli_query($conn, $sql);

            if($result){
                if($_SESSION['usertype'] === "HOA"){
                    header('location: /project/dummy/onboarding/hospitalinfo.php');
                } elseif ($_SESSION['usertype'] === "DOC") {
                    header('location: /project/dummy/main/dashboard.php');
                }
            }
        }

    }
?>
