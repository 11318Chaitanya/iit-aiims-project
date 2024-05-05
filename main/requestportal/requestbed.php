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
        ?>

        <main class="container d-flex flex-column mx-2 my-2">
            <?php
                if(isset($_GET['bedRequestSuccess']) && $_GET['bedRequestSuccess']=="true"){
                    echo '<div class="alert alert-success alert-dismissible fade show my-0 mb-2" role="alert">
                <strong>Successful!</strong> Request sent successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                else if(isset($_GET['bedRequestSuccess']) && $_GET['bedRequestSuccess']=="false"){
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 mb-2" role="alert">
                <strong>Error! </strong> Failed to send request.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            ?>
                <h1 class="mb-4">Request Bed</h1>
                <form action="/project/healthcarepro/partials/handelrequests/__handelbedrequest.php" method="post">
                <div class="mb-3">
                    <label for="hospital_id" class="form-label">Hospital</label>
                    <select class="form-select" aria-label="Default select example" name="hospital_id" id="hospital_id">
                        <?php
                            
                            $sql = "SELECT * FROM `hospitalinfo` WHERE `hospital_id` <> '$hospital_id'";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result)){
                                echo '<option value="'.$row['hospital_id'].'">'.$row['hospital_name'].'</option>';
                            }
                        ?>  
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bed_type" class="form-label">Bed Type</label>
                    <select class="form-select" aria-label="Default select example" name="bed_type" id="bed_type">
                                
                    </select>
                </div> 
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient Id</label>
                    <input type="text" class="form-control" id="patient_id" name="patient_id">
                </div>
                <div class="mb-3">
                    <label for="date_for_admission" class="form-label">Date For Admission</label>
                    <input type="date" class="form-control" id="date_for_admission" name="date_for_admission"
                        aria-describedby="dateHelp">
                    <div id="dateHelp" class="form-text">Mention date on which the patient needs to be admitted.</div>
                </div>
                <div class="mb-3">
                    <label for="request_description" class="form-label">Request Description</label>
                    <textarea class="form-control" id="request_description" name="request_description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>            
        </main>
    </div>
    <script>
        // Your JavaScript code here
        document.getElementById('hospital_id').addEventListener('change', function() {
            var hospitalId = this.value; // Get the selected bed type
            var xhr = new XMLHttpRequest(); // Create new XMLHttpRequest object
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update options of the second dropdown
                    document.getElementById('bed_type').innerHTML = this.responseText;
                    console.log(this.responseText);
                }
            };
            // Send AJAX request to fetch available bed numbers based on bed type
            xhr.open("GET", "get_bed_type.php?hospitalId=" + hospitalId, true);
            xhr.send();
        });
        document.getElementById('hospital_id').dispatchEvent(new Event('change'));  
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