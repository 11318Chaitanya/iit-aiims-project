<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        include "../__dbconnect.php";

        $useremail = $_POST['useremail'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];

        $sql = "SELECT * FROM `logusers` WHERE `user_email`='$useremail' AND `user_type`='$usertype'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);
        
        if($num == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['user_password'])){
                if(empty($_POST['usertype'])){
                    $userError = "Please select user type";
                }else{
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['userEmail'] = $useremail;
                    $_SESSION['usertype'] = $row['user_type'];
                    $_SESSION['sno'] = $row['sno'];

                    if ($row['user_type'] === "ADM") {
                        header('location: /project/dummy/main/dashboard.php?1usertype='.$row['user_type'].'');
                        exit();
                    } elseif ($row['user_type'] === "HOA" && $row['register_progress'] === "UI") {
                        header('location: /project/dummy/onboarding/userinfo.php');
                        exit();
                    } elseif ($row['user_type'] === "HOA" && $row['register_progress'] === "HI") {
                        header('location: /project/dummy/onboarding/hospitalinfo.php');
                        exit();
                    } elseif ($row['user_type'] === "HOA" && $row['register_progress'] === "CO") {
                        header('location: /project/dummy/main/dashboard.php?2usertype='.$row['user_type'].'');
                        exit();
                    } elseif ($row['user_type'] === "DOC" && $row['register_progress'] === "UI") {
                        header('location: /project/dummy/onboarding/userinfo.php');
                        exit();
                    } elseif ($row['user_type'] === "DOC" && $row['register_progress'] === "CO") {
                        header('location: /project/dummy/main/dashboard.php?3usertype='.$row['user_type'].'');
                        exit();
                    }
                    else{
                        $userError="User do not exist";
                    }
                }
            }
            else{
                $userError = "Incorrect password";
            }
        }
        else{
            $userError = "User do not exist";
        }
        header("location: /project/dummy/onboarding/login.php?logSuccess=false&error=$userError");
    }


?>