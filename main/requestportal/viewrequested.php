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


        <main class="d-flex flex-column mx-2">

            <section class="section my-2 py-2 px-4">
                <h2>Bed Request Status</h2>
                <?php
                $user_id = (int)$_SESSION['sno'];
                    echo '<table class="table text-center" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" class="form-check-input" id="exampleCheck1"></th>
                            <th scope="col">Request To</th>
                            <th scope="col">Requested Bed Type</th>
                            <th scope="col">Patient Id</th>
                            <th scope="col">Request Description</th>
                            <th scope="col">Request Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $sql = "SELECT * FROM `bedrequest` WHERE `req_from` = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $requestedtoId = $row['req_to'];
                        $sql_hf = "SELECT * FROM `hospitalinfo` WHERE `user_id` = '$requestedtoId'";
                        $result_hf = mysqli_query($conn, $sql_hf);
                        $row_hf = mysqli_fetch_assoc($result_hf);

                        echo  ' <tr>
                            <th scope="col"><input type="checkbox" class="form-check-input" id="exampleCheck1"></th>
                            <td>'.$row_hf['hospital_name'].'</td>
                            <td>'.$row['bed_type'].'</td>
                            <td><a href="#">'.$row['patient_id'].'</a></td>
                            <td><a href="#" class="btn btn-primary">View</a></td>
                            <td>'.$row['req_status'].'</td>
                            <td><a href="#" class="btn btn-primary me-2">Delete</a></td>
                        </tr>';
                    }
                    
                echo '</tbody>
                    </table>';
                ?>

            </section>

            <section class="section my-2 py-2 px-4">
                <h2>Patient Information Request Status</h2>
                <table class="table text-center" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" class="form-check-input" id="exampleCheck1"></th>
                            <th scope="col">Request To</th>
                            <th scope="col">Patient Id</th>
                            <th scope="col">Request Description</th>
                            <th scope="col">Request Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $user_id = (int)$_SESSION['sno'];
                            $sql = "SELECT * FROM `patientinforeq` WHERE `req_from` = '$user_id'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $requestedtoId = $row['req_to'];
                                $sql_hf = "SELECT * FROM `hospitalinfo` WHERE `user_id` = '$requestedtoId'";
                                $result_hf = mysqli_query($conn, $sql_hf);
                                $row_hf = mysqli_fetch_assoc($result_hf);

                                echo '<tr>
                                        <td><input type="checkbox" class="form-check-input" id="exampleCheck1"></td>
                                        <td>' . $row_hf['hospital_name'] . '</td>
                                        <td><a href="#">' . $row['patient_id'] . '</a></td>
                                        <td><a href="#" class="btn btn-primary">View</a></td>
                                        <td>' . $row['req_status'] . '</td>
                                        <td><button class="btn btn-primary me-2 delete-btn" data-id="' . $row['sno'] . '">Delete</button></td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </section>



        </main>
    </div>

    <script>
    // Add event listener to delete buttons
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Get the ID of the entry to be deleted
            const requestId = this.getAttribute('data-id');

            // Send AJAX request to delete entry
            fetch('/handelchanges/deleterequest.php?id=' + requestId, {
                    method: 'DELETE',
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the row from the table
                        this.closest('tr').remove();
                    } else {
                        console.error('Failed to delete entry');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
    </script>

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