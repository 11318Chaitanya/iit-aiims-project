<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "../__dbconnect.php";

    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    $hospital_id = $POST['hospital_id'];

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
                header('location: /project/healthcarepro/main/adddoctor.php?subSuccess=true');
                exit();
            }
        }
    }
    else{
        $userError= "Some error occurred";
    }

    header("location: /project/healthcarepro/main/adddoctor.php?subSuccess=false&error=$userError");
}


?>