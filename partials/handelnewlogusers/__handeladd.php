<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "../__dbconnect.php";

    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    if(isset($_POST['hospital_id']) && $_POST['hospital_id'] !== ''){
        $hospital_id = $_POST['hospital_id'];
    }

    if(isset($_GET['add']) && $_GET['add'] !== ''){
        $user_type = $_GET['add'];

        $sql = "SELECT * FROM `logusers` WHERE `user_email`='$useremail'";
        $result = mysqli_query($conn, $sql);
    
        $num = mysqli_num_rows($result);
        if($num>0){
            $userError = "Email already exists";
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sqlm = "INSERT INTO `logusers` (`user_email`, `user_password`,`user_type`,`register_progress`,`tstamp`) VALUES ('$useremail', '$hash','$user_type','UI',current_timestamp())";
            $resultm = mysqli_query($conn, $sqlm);
            if($resultm){
                $subSucess = true;
                if($hospital_id){
                    $sqls = "SELECT * FROM `logusers` WHERE `user_email` = '$useremail'";
                    $results = mysqli_query($conn, $sqls);
                    $rows = mysqli_fetch_assoc($results);
                    $doctor_id = $rows['sno']; // Fetching the doctor ID
                    $sqlh = "INSERT INTO `hospitaldata` (`hospital_id`, `doctor_id`, `tstamp`) VALUES ('$hospital_id', '$doctor_id', current_timestamp())";
                    $resulth = mysqli_query($conn, $sqlh);                   
                    if($resulth){
                        header('location: /project/healthcarepro/main/adddoctor.php?subSuccess=true');
                        exit();
                    }
                }
                header('location: /project/healthcarepro/main/addhospitaladmin.php?subSuccess=true');
                exit();
            }
        }
    }
    else{
        $userError= "Some error occurred";
    }

    if($hospital_id){
        header("location: /project/healthcarepro/main/adddoctor.php?subSuccess=false&error=$userError");
    }else{
        header("location: /project/healthcarepro/main/addhospitaladmin.php?subSuccess=false&error=$userError");
    }
}


?>