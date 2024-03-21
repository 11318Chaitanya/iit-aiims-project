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

    a {
        text-decoration: none;
    }

    #imageUploadContainer {
        display: none;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php';?>
        <?php include '../partials/__dbconnect.php'?>

        <?php 
        
        if(isset($_GET['patientId']) && $_GET['patientId'] != ''){

            $patientId = $_GET['patientId'];

            $sql = "SELECT * FROM `patientinfo` WHERE `patient_id` = '$patientId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            echo '<main class="container-fluid d-flex flex-column mx-2">
            <section class="section my-2 py-2 px-4">
                <div class="row justify-content-evenly">
                    <div class="card col-6">
                        <div class="card-body">
                            <h5 class="card-title">Personal Details</h5>
                            <form action="/project/healthcarepro/partials/handelpatientdatachange/handelpatientinfochange.php" method="post" enctype="multipart/form-data">
                                <div class="row align-items-between personalDetails">
                                    <div class="mb-3 col-5">
                                        <img src="../assests/patientfile/'.$row['patient_profile_pic'].'" alt="" width="200px" height="200px">
                                        <div class="mb-3 flex-column justify-content-center" id="imageUploadContainer">
                                            <label for="patientpicture" class="form-label">Upload Profile picture</label>
                                            <input type="file" class="form-control" id="patientpicture" name="patientpicture">
                                        </div> 
                                    </div>
                                    <div class="col-7 align-items-center">
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="patientid" class="form-label me-2">Patient Id:</label>
                                            <input type="text" class="form-control" id="patientid" name="patientid"
                                                style="width:auto;" value="'.$row['patient_id'].'" readonly disabled>
                                                <button type="button" class="btn btn-primary" id="generatePatientIdButton" style="display:none;"
                                    onclick="generatePatientId()">Generate</button>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="patientname" class="form-label me-2">Name:</label>
                                            <input type="text" class="form-control" id="patientname" name="patientname"
                                                style="width:auto;" value="'.$row['patient_name'].'" disabled>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="gender" class="form-label me-2">Gender:</label>
                                            <select class="form-select" aria-label="Default select example"
                                                    name="patientgender" id="patientgender" style="width:auto;"
                                                    disabled>
                                                    <option value="Male" ' . ($row['patient_gender'] === 'Male' ? 'selected' : '') . '>Male</option>
                                                    <option value="Female" ' . ($row['patient_gender'] === 'Female' ? 'selected' : '') . '>Female</option>
                                                    <option value="Others" ' . ($row['patient_gender'] === 'Others' ? 'selected' : '') . '>Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="patientdob" class="form-label me-2">Date of Birth:</label>
                                            <input type="date" class="form-control" id="patientdob" name="patientdob"
                                                style="width:auto;" value="'.$row['patient_dob'].'" disabled>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="patientcontactnum" class="form-label me-2">Contact Number:</label>
                                            <input type="tel" class="form-control" id="patientcontactnum"
                                                style="width:auto;" name="patientcontactnum" value="'.$row['patient_contact_num'].'" disabled>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <label for="patientadharnum" class="form-label me-2">Adhar Card Number:</label>
                                            <input type="text" class="form-control" id="patientadharnum"
                                                style="width:auto;" name="patientadharnum" value="'.$row['patient_adhar_num'].'" disabled>
                                        </div>
                                    </div>
                                    <button type="button" id="personalEdit" class="btn btn-primary">Edit</button>
                                    <button type="submit" id="personalSubmit" class="btn btn-primary" style="display:none">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Patient Vitals</h5>
                                <div class="mb-2 d-flex align-items-center">
                                    <label for="patientbp" class="form-label me-2">Blood Pressure:</label>
                                    <input type="text" class="form-control" style="width:auto;" id="patientbp"
                                        name="patientbp" value="'.$row['patient_bp'].'" disabled>
                                </div>
                                <div class="mb-2 d-flex align-items-center">
                                    <label for="patientsugar" class="form-label me-2">Sugar level:</label>
                                    <input type="text" class="form-control" style="width:auto;" id="patientsugar"
                                        name="patientsugar" value="'.$row['patient_sugar'].'" disabled>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="d-inline-flex">Last updated: 00:00:00</p><a href=""
                                        class="btn btn-primary">update</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Patient Category</h5>
                                <div class="mb-3 d-flex align-items-center">
                                    <label for="patientcategory" class="form-label">Patient Category</label>
                                    <select class="form-select" aria-label="Default select example"
                                        name="patientcategory" id="patientcategory" disabled>
                                        <option value="'.$row['patient_category'].'">'.$row['patient_category'].'</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="patientseverity" class="form-label me-3">Severity index</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="patientseverity"
                                            id="patient_severity1" value="'.$row['patient_severity'].'" checked>
                                        <label class="form-check-label text-success"
                                            for="patient_severity1">'.$row['patient_severity'].'</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="filesContainer">
                        <!--
                        <iframe style="height:975px; width:100%;" src="../assests/userdefault.jpg" frameborder="0"></iframe>
                            <iframe style="height:975px; width:100%;" src="example.pdf" frameborder="0"></iframe>
                        -->
                        
                        </div>
                        <div class="modal-footer" id="modalFooter">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary addFile">Add File</button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="section my-2 py-2 px-4">
                <div class="row justify-content-evenly">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Files:</h5>';

                                function viewFiles($label, $id, $value) {
                                    $idString = json_encode(unserialize($id));
                                    echo '<div class="mb-3 d-flex align-items-center mb-3">
                                                <p>' . $label . '</p>
                                                <button type="button" class="filesModalButton btn btn-primary ms-3" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" id="' .htmlspecialchars($idString). '">
                                                    View Files
                                                </button>
                                                <input class="fileCategory" value="'.$value.'" hidden>
                                            </div>';
                                }

                                $sql_p = "SELECT * FROM `patientfile` WHERE `patient_id` = '$patientId'";
                                $result_p = mysqli_query($conn, $sql_p);
                                $row_p = mysqli_fetch_assoc($result_p);
                                
                                viewFiles('Patient Images & Videos:',$row_p['patient_img_vid'] ?? '', 'patient_img_vid');
                                viewFiles('Diagnostic Files:', $row_p['patient_diagnostic_file'] ?? '', 'patient_diagnostic_file');
                                viewFiles('Medication Files:', $row_p['patient_medication_file'] ?? '', 'patient_medication_file');
                            echo '</div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Medical Details</h5>
                        <form action="/project/healthcarepro/partials/handelpatientdatachange/handelpatientinfochange.php" method="post">
                        ';
                        
                        function medicalDetailTextarea($label, $value, $name) {
                            echo '
                            <div class="mb-3 d-flex align-items-center form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                    id="'.$name.'" name="'.$name.'" style="height: 100px"
                                    disabled>' . $value . '</textarea>
                                <label for="floatingTextarea2Disabled">' . $label . '</label>
                            </div>';
                        }
                        medicalDetailTextarea('Diagnostic Details', $row['patient_diagnostic_text'], 'patientdiagnostictext'); 
                        medicalDetailTextarea('Medications Given', $row['patient_medication_text'], 'patientmedicationtext'); 
                        medicalDetailTextarea('Medical history', $row['patient_medical_history'], 'patientmedicalhistory'); 
                        medicalDetailTextarea("Doctor's comment", $row['doctor_comment'], 'doctorcomment'); 
                        echo '
                        <input value="'.$patientId.'" name="patientid" hidden>
                        <button type="button" class="btn btn-primary" id="medicalEdit">Edit</button>
                        <button type="submit" class="btn btn-primary" id="medicalSubmit" style="display:none">Submit</button>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>';

        }
        
        ?>
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
    // handeling personal info
    const editButton = document.getElementById('personalEdit');
    editButton.addEventListener('click', () => {
        document.getElementById('personalSubmit').style.display = 'block';
        document.getElementById('imageUploadContainer').style.display = 'flex';
        document.getElementById('generatePatientIdButton').style.display = "inline-flex";
        editButton.style.display = 'none';

        const fields = document.querySelectorAll(
            '#patientid ,#patientname, #patientgender, #patientdob, #patientcontactnum, #patientadharnum, #patientgender'
        );
        // Enable all input fields
        fields.forEach(field => {
            field.removeAttribute('disabled');
        });

    });

    // handeling medical info
    document.getElementById('medicalEdit').addEventListener('click', () => {
        // Get all textarea elements
        const textareas = document.querySelectorAll('.card-body textarea');
        document.getElementById('medicalSubmit').style.display = "block";
        document.getElementById('medicalEdit').style.display = "none";
        // Enable all textarea elements
        textareas.forEach(textarea => {
            textarea.removeAttribute('disabled');
        });
    });

    /* global bootstrap: false */
    (() => {
        'use strict'
        const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(tooltipTriggerEl => {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })()


    // handeling file data 

    const filesModalButtons = document.querySelectorAll('.filesModalButton');
    filesModalButtons.forEach(button => {
        button.addEventListener('click', (e) => {

            const fileCategory = e.target.parentNode.querySelector('.fileCategory').value;
            console.log(fileCategory);

            console.log('clicked');
            const files = JSON.parse(e.target.id);
            console.log(files);
            document.getElementById('filesContainer').innerHTML = '';
            Array.from(files).forEach(file => {
                const iframe = document.createElement('iframe');
                const hr = document.createElement('hr');
                const p = document.createElement('p');
                const a = document.createElement('a');
                const div = document.createElement('div');

                div.classList.add('fileContainerMain');

                p.innerHTML =
                    `<b>${file}</b><button class="btn btn-primary removeFiles">Remove</button>`;
                iframe.style.width = "80%";
                iframe.style.height = "985px";
                p.classList.add("d-inline-flex");
                console.log(file);
                iframe.src = '../assests/patientfile/' + file;
                div.appendChild(p);
                div.appendChild(a);
                div.appendChild(iframe);
                div.appendChild(hr);
                document.getElementById('filesContainer').appendChild(div);


                // Get the current URL
                const currentUrl = window.location.href;

                // Extract the query string part of the URL
                const queryString = currentUrl.split('?')[1];

                // Split the query string into individual key-value pairs
                const queryParams = queryString.split('&');

                // Loop through the key-value pairs to find the patientId parameter
                let patientId = null;
                for (const param of queryParams) {
                    const [key, value] = param.split('=');
                    if (key === 'patientId') {
                        patientId = value;
                        break;
                    }
                }

                console.log(patientId);

                function sendRequest(filePath) {
                    var xhr = new XMLHttpRequest(); // Create new XMLHttpRequest object
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // Update options of the second dropdown
                            console.log(this.responseText);
                        }
                    };
                    // Send AJAX request to fetch available bed numbers based on bed type
                    xhr.open("GET",
                        filePath, true);
                    xhr.send();
                }

                // document.querySelector('.addFile').addEventListener('click', () => {

                //     sendRequest(
                //         "../partials/handelpatientdatachange/deletefile.php?patientId=" +
                //         patientId +
                //         "&fileCategory=" + fileCategory);
                // })


                // Adding click event listener to the removeFiles button
                p.querySelector('.removeFiles').addEventListener('click', () => {
                    // console.log('Remove clicked for', file);

                    sendRequest(
                        "../partials/handelpatientdatachange/deletefile.php?patientId=" +
                        patientId +
                        "&fileName=" + file +
                        "&fileCategory=" + fileCategory);

                    const divContainer = p.closest('.fileContainerMain');

                    // Remove the parent div container
                    divContainer.remove();
                });


            })
        });
    });
    </script>



</body>

</html>