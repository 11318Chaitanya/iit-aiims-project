<?php
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header('location: /project/healthcarepro/onboarding/login.php');
        exit();
    }
?>
