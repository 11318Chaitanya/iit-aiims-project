<?php include '../../partials/__sessionconnect.php'?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assests/css/sidebar.css">
    <style>
    /* section {
        overflow: auto;
    } */
    main {
        overflow: auto;
        width: 100%;
    }

    a {
        text-decoration: none;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include '../sidebar.php';?>
        <?php include '../../partials/__dbconnect.php'?>


        <main class="container d-flex flex-column mx-2 my-2">
            <?php
                if(isset($_GET['pirs']) && $_GET['pirs']=="true"){
                    echo '<div class="alert alert-success alert-dismissible fade show my-0 mb-2" role="alert">
                <strong>Successful!</strong> Request sent successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                else if(isset($_GET['pirs']) && $_GET['pirs']=="false"){
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 mb-2" role="alert">
                <strong>Error! </strong> Failed to send request.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                ?>
                <h1 class="mb-4">Request Patient Info</h1>
                <form action="/project/healthcarepro/partials/handelrequests/__handelpatientinforeq.php" method="post">

                <div class="mb-3">
                    <label for="hospital_id" class="form-label">Hospital</label>
                    <select class="form-select" aria-label="Default select example" name="hospital_id">
                        <?php
                            $user_id = (int)$_SESSION['sno'];

                            // getting hospital id according to user id 
                            if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
                                $sql = "SELECT * FROM `hospitaldata` WHERE `doctor_id` = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $hospital_id = $row['hospital_id'];
                            } else{
                                $sql = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $hospital_id = $row['hospital_id'];
                            }
                                $sql = "SELECT * FROM `hospitalinfo` WHERE `hospital_id` <> '$hospital_id'";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo '<option value="'.$row['hospital_id'].'">'.$row['hospital_name'].'</option>';
                                }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient Id</label>
                    <input type="text" class="form-control" id="patient_id" name="patient_id"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="request_description" class="form-label">Request Description</label>
                    <textarea class="form-control" id="request_description" name="request_description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    /* global bootstrap: false */
    (() => {
        'use strict'
        const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(tooltipTriggerEl => {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })()
    </script>

</body>

</html>