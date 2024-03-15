<?php

session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assests/css/sidebar.css">
    <style>
    /* section {
        overflow: auto;
    } */
    main {
        overflow: auto;
    }
    a{
        text-decoration: none;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php';?>
        <?php include '../partials/__dbconnect.php'?>


        <main class="d-flex flex-column mx-2">
            <section class="section my-2 py-2 px-4">
                <div class="row justify-content-evenly">
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of
                                the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of
                                the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section my-2 py-2 px-4">

                <?php
                            
                $user_id = (int)$_SESSION['sno'];

                // getting hospital id according to user id 
                if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
                    
                    echo '<h2>Your patients:</h2>';

                    $sql = "SELECT * FROM `patientinfo` WHERE `doctor_id` = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    

                    echo '<table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Bed No</th>
                            <th scope="col">Bed Type</th>
                            <th scope="col">Patient Id</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Severity</th>
                            <th scope="col">Patient Category</th>
                            <th scope="col">Patient Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    while($row = mysqli_fetch_assoc($result)) {

                        $allotedBed = $row['alloted_bed'];
                        if($allotedBed===""){
                            $bedType = "ANY";
                            $bedNum = "ANY";
                        }else{
                            $parts = explode("-", $allotedBed);
                        // Extracting bed type and number
                        $bedType = $parts[0]; // GS
                        $bedNum = $parts[1]; // 2
                        }

                        echo  ' <tr>
                            <td>'.$bedNum.'</td>
                            <td>'.$bedType.'</td>
                            <td><a href="">'.$row['patient_id'].'</a></td>
                            <td>'.$row['patient_name'].'</td>
                            <td>'.$row['patient_severity'].'</td>
                            <td>'.$row['patient_category'].'</td>
                            <td>'.$row['patient_status'].'</td>
                            <td><a href="#" class="btn btn-primary me-2">Edit</a></td>
                        </tr>';
                    }
                    
                echo '</tbody>
                    </table>';

                } elseif(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'HOA'){

                    echo '<h2>Your Hospital patients:</h2>';

                    $sql_h = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
                    $result_h = mysqli_query($conn, $sql_h);
                    $row_h = mysqli_fetch_assoc($result_h);
                    $hospital_id = $row_h['hospital_id'];

                    $sql = "SELECT * FROM `patientinfo` WHERE `hospital_id` = '$hospital_id'";
                    $result = mysqli_query($conn, $sql);
                    

                    echo '<table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Bed No</th>
                            <th scope="col">Bed Type</th>
                            <th scope="col">Patient Id</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Severity</th>
                            <th scope="col">Patient Category</th>
                            <th scope="col">Patient Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    while($row = mysqli_fetch_assoc($result)) {

                        $allotedBed = $row['alloted_bed'];
                        if($allotedBed===""){
                            $bedType = "ANY";
                            $bedNum = "ANY";
                        }else{
                            $parts = explode("-", $allotedBed);
                        // Extracting bed type and number
                        $bedType = $parts[0]; // GS
                        $bedNum = $parts[1]; // 2
                        }
                        echo  ' <tr>
                            <td>'.$bedNum.'</td>
                            <td>'.$bedType.'</td>
                            <td><a href="">'.$row['patient_id'].'</a></td>
                            <td>'.$row['patient_name'].'</td>
                            <td>'.$row['patient_severity'].'</td>
                            <td>'.$row['patient_category'].'</td>
                            <td>'.$row['patient_status'].'</td>
                            <td><a href="#" class="btn btn-primary me-2">Edit</a></td>
                        </tr>';
                    }
                    
                echo '</tbody>
                    </table>';
                }
            
            ?>
            </section>
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