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
    main {
        height: 100%;
        width: 100%;
        overflow: auto;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php';?>
        <?php include '../partials/__dbconnect.php'?>

        <main class="d-flex mx-2">
            <div class="container my-4">
                <?php
            
            if(isset($_GET['subSuccess']) && $_GET['subSuccess']=="true"){
                echo '<div class="alert alert-success alert-dismissible fade show my-0 mb-2" role="alert">
              <strong>Successful!</strong> Patient added successfully.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            else if(isset($_GET['subSuccess']) && $_GET['subSuccess']=="false"){
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 mb-2" role="alert">
              <strong>Error! </strong> Failed to add Patient.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            ?>
                <h1>Add Patient</h1>
                <form action="/project/healthcarepro/partials/handelsubmission/__handelpatientdata.php" method="post"
                    enctype="multipart/form-data">
                    <h2>Personal details: </h2>
                    <div class="mb-3 d-flex">
                        <img src="../assests/userdefault.jpg" alt="" width="200px" height="200px">
                        <div class="mb-3 d-flex flex-column justify-content-center">
                            <label for="patientpicture" class="form-label">Upload Profile picture</label>
                            <input type="file" class="form-control" id="patientpicture" name="patientpicture">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="patientname" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="patientname" name="patientname">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label me-3">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientgender" id="gender_radio1"
                                value="Male">
                            <label class="form-check-label" for="gender_radio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientgender" id="gender_radio2"
                                value="Female">
                            <label class="form-check-label" for="gender_radio2">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientgender" id="gender_radio3"
                                value="Others">
                            <label class="form-check-label" for="gender_radio3">Others</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="patientdob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="patientdob" name="patientdob">
                    </div>
                    <div class="mb-3">
                        <label for="patientcontactnum" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="patientcontactnum" name="patientcontactnum">
                    </div>
                    <div class="mb-3">
                        <label for="patientadharnum" class="form-label">AdharCard Number</label>
                        <input type="number" class="form-control" id="patientadharnum" name="patientadharnum">
                    </div>
                    <div class="mb-3">
                        <label for="patientid" class="form-label">Patient Id</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="patientid" name="patientid" readonly>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary"
                                    onclick="generatePatientId()">Generate</button>
                            </div>
                        </div>
                    </div>
                    <h2>Medical details: </h2>
                    <div class="mb-3">
                        <label for="patientbp" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="patientbp" name="patientbp">
                    </div>
                    <div class="mb-3">
                        <label for="patientsugar" class="form-label">Sugar level</label>
                        <input type="number" class="form-control" id="patientsugar" name="patientsugar">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="patientcategory" class="form-label">Patient Category</label>
                        <select class="form-select" aria-label="Default select example" name="patientcategory"
                            id="patientcategory">
                            <option value="Burn Condition">Burn Condition</option>
                            <option value="Physical Condition">Physical Condition</option>
                            <option value="Lung Condition">Lung Condition</option>
                            <option value="Heart Condition">Heart Condition</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patientimgvid" class="form-label">Patient Images/videos</label>
                        <input type="file" class="form-control" id="patientimgvid" name="patientimgvid[]" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="patientseverity" class="form-label me-3">Severity index</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientseverity" id="patient_severity1"
                                value="Normal">
                            <label class="form-check-label text-success" for="patient_severity1">Normal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientseverity" id="patient_severity2"
                                value="Mild">
                            <label class="form-check-label text-warning" for="patient_severity2">Mild</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patientseverity" id="patient_severity3"
                                value="High">
                            <label class="form-check-label text-danger" for="patient_severity3">High</label>
                        </div>
                    </div>
                    <h3>Diagnostics:</h3>
                    <div class="mb-3">
                        <label for="patientdiagnostictext" class="form-label">Details:</label>
                        <textarea name="patientdiagnostictext" id="patientdiagnostictext" cols="30" rows="5"
                            class="form-control"></textarea>
                        <div class="d-flex mt-3 align-items-center">
                            <span>Add images/files:</span><input type="file" class="form-control"
                                id="patientdiagnosticfile" name="patientdiagnosticfile[]" multiple>
                        </div>
                    </div>
                    <h3>Medication:</h3>
                    <div class="mb-3">
                        <label for="patientmedicationtext" class="form-label">Medications given:</label>
                        <textarea name="patientmedicationtext" id="patientmedicationtext" cols="30" rows="5"
                            class="form-control"></textarea>
                        <div class="d-flex mt-3 align-items-center">
                            <span>Add images/files:</span><input type="file" class="form-control"
                                id="patientmedicationfile" name="patientmedicationfile[]" multiple>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="patientmedicalhistory" class="form-label">Medical History:</label>
                        <textarea name="patientmedicalhistory" id="patientmedicalhistory" cols="30" rows="5"
                            class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="doctorcomment" class="form-label">Doctor's comment:</label>
                        <textarea name="doctorcomment" id="doctorcomment" cols="30" rows="5"
                            class="form-control"></textarea>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <label for="patientstatus" class="form-label">Patient Status</label>
                        <select class="form-select" aria-label="Default select example" name="patientstatus"
                            id="patientstatus">
                            <option value="Current">Current</option>
                            <option value="Discharged">Discharged</option>
                            <option value="Moved">Moved</option>
                            <option value="Passed Away">Passed away</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="allotedbed me-3" class="form-label">Alloted Bed</label>
                        <select class="form-select mx-2" aria-label="Default select example" name="allotedbedtype" id="allotedbedtype">
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


                                echo '<option value="any">Any</option>';
                                $sql = "SELECT DISTINCT `bed_type` FROM `bedinfo` WHERE `bed_availibility`='Available' AND `hospital_id`='$hospital_id'";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value='{$row['bed_type']}' selected>{$row['bed_type']}</option>";
                                }
                            ?>  
                        </select>
                        <select class="form-select" aria-label="Default select example" name="allotedbednum" id="allotedbednum">
                            <option value="any">Any</option>
                        </select>
                    </div>

                    <script>
                        document.getElementById('allotedbedtype').addEventListener('change', function() {
                            var bedType = this.value; // Get the selected bed type
                            var xhr = new XMLHttpRequest(); // Create new XMLHttpRequest object
                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Update options of the second dropdown
                                    document.getElementById('allotedbednum').innerHTML = this.responseText;
                                }
                            };
                            // Send AJAX request to fetch available bed numbers based on bed type
                            xhr.open("GET", "get_bed_numbers.php?bedType=" + bedType, true);
                            xhr.send();
                        });
                    </script>

                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Admitted under</label>
                        <select class="form-select mx-2" aria-label="Default select example" name="doctorid">
                            <?php
                                if(isset($_SESSION['sno']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
                                    $sql = "SELECT * FROM `userinfo` WHERE `user_id`='" . $_SESSION['sno'] . "'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo "<option value='{$row['user_id']}' selected>{$row['username']}</option>";
                                }
                                if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'DOC'){
                                    $sql_hos = "SELECT * FROM `hospitaldata` WHERE `doctor_id`='".$_SESSION['sno']."'";
                                }
                                else{
                                    $sql_hos = "SELECT * FROM `hospitalinfo` WHERE `user_id`='".$_SESSION['sno']."'";
                                }
                                $result_hos = mysqli_query($conn, $sql_hos);
                                $row_hos = mysqli_fetch_assoc($result_hos);
                                $hospital_id = $row_hos['hospital_id'];

                                $sql_hos_doc = "SELECT * FROM `hospitaldata` WHERE `hospital_id`='$hospital_id'";
                                $result_hos_doc = mysqli_query($conn, $sql_hos_doc);
                                while ($row_hos_doc = mysqli_fetch_assoc($result_hos_doc)){
                                    $sql_doc = "SELECT * FROM `userinfo` WHERE `user_id`='" . $row_hos_doc['doctor_id'] . "' AND `user_id` != '" . $_SESSION['sno'] . "'";
                                    $result_doc = mysqli_query($conn, $sql_doc);
                                    $row_doc = mysqli_fetch_assoc($result_doc);
                                    if($row_doc['user_id'] != NULL){
                                        echo "<option value='{$row_doc['user_id']}'>{$row_doc['username']}</option>";
                                    }
                                }
                            
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
            </div>
        </main>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    function generatePatientId() {
        // Get the values of patient name, date of birth, and Aadhar number
        var patientName = document.getElementById('patientname').value;
        var patientDob = document.getElementById('patientdob').value;
        var patientAadhar = document.getElementById('patientadharnum').value;

        // Check if all fields are filled
        if (patientName && patientDob && patientAadhar) {
            // Extract initials from name
            var initials = getInitials(patientName);

            // Extract last two digits of the year from date of birth
            // var dobYear = patientDob.substring(patientDob.length - 4);

            var dob = convertDateToYYYYMMDD(patientDob);

            // Take the first five digits from the Aadhar number
            var aadharDigits = patientAadhar.substring(8, 12);

            // Concatenate the parts to form the patient ID
            var patientId = initials.toUpperCase() + dob + "_" + aadharDigits;

            // Fill the patient id field
            document.getElementById('patientid').value = patientId;
            console.log(patientId);
        } else {
            alert('Please fill in all the reqired fields.');
        }
    }

    // Function to extract initials from name
    function getInitials(name) {
        var parts = name.split(' ');
        var initials = '';
        for (var i = 0; i < parts.length; i++) {
            initials += parts[i].charAt(0);
        }
        return initials;
    }
    // Function to generate dob
    function convertDateToYYYYMMDD(dateString) {
        // Split the input string into year, month, and day components
        var parts = dateString.split('-');

        // Concatenate the components to form the YYYYMMDD format
        var formattedDate = parts[0] + parts[1] + parts[2];

        return formattedDate;
    }
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