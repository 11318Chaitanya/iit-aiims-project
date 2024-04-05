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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    main {
        overflow: auto;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include '../sidebar.php';?>
        <?php include '../../partials/__dbconnect.php'?>

        <main class="d-flex flex-column mx-2" style="width:100%">
            <div class="container my-2">
                <?php 
                $user_id = (int)$_SESSION['sno'];
                
                if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'HOA'){
                    $sql = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $hospitalId = $row['hospital_id'];
                }elseif(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
                    $sql = "SELECT * FROM `hospitaldata` WHERE `doctor_id` = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $hospitalId = $row['hospital_id'];
                }


                echo'<h1>Your Hospital Bed Info:</h1>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Bed No</th>
                            <th scope="col">Bed Type</th>
                            <th scope="col">Bed Availibility</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                
                $sql = "SELECT * FROM `bedinfo` WHERE `hospital_id` = '$hospitalId'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result)){
                    echo '<tr>
                            <td>'.$row['bed_num'].'</td>
                            <td>'.$row['bed_type'].'</td>
                            <td>'.$row['bed_availibility'].'</td>
                            <td><a href="/project/healthcarepro/main/addpatient.php?bedNum='.$row['bed_num'].'&bedType='.$row['bed_type'].'" class="btn btn-primary me-2';
                        echo $row['bed_availibility'] === 'Available' ? '' : ' disabled'; // Adding the 'disabled' class conditionally
                        echo '">Add patient</a></td>
                        </tr>';
                }
                echo '</tbody>
                    </table>';
            ?>

            </div>
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