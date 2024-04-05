<?php include '../partials/__sessionconnect.php'?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php';?>
        <?php include '../partials/__dbconnect.php'?>

        <main class="d-flex flex-column mx-2" style="width:100%">
            <div class="container my-2">
                <?php
                if(isset($_GET['subSuccess']) && $_GET['subSuccess']=="true"){
                    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                  <strong>Successful!</strong> Doctor added successfully
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
                else if(isset($_GET['subSuccess']) && $_GET['subSuccess']=="false"){
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                  <strong>Error! </strong>' .$_GET['error']. '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
                ?>
            <h1 class="my-3">Add doctor</h1>
                <form  id="addDoctorForm" action="/project/healthcarepro/partials/handelnewlogusers/__handeladd.php?add=HOA" method="post">
                    <div class="mb-3">
                        <label for="hospital_id" class="form-label">Hospital</label>    
                        <select class="form-select" aria-label="Default select example" name="hospital_id">
                            <?php
                                $user_id = (int)$_SESSION['sno'];
                    
                                $hospitalId = null;
                                if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'HOA'){
                                    $sql = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $hospitalId = $row['hospital_id'];
                                }

                                if($hospitalId){
                                    $sql = "SELECT * FROM `hospitalinfo` WHERE `hospital_id` = '$hospitalId'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                        echo '<option value="'.$hospitalId.'">'.$row['hospital_name'].'</option>';
                                }else{
                                    $sql = "SELECT * FROM `hospitalinfo`";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['hospital_id'].'">'.$row['hospital_id'].'</option>';
                                    }
                                }
                            ?>  
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="useremail" name="useremail"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" id="password" name="password">
                            <button type="button" onclick="generatePassword()" class="btn btn-primary">Generate Password</button>
                        </div>
                    </div>
                    <button type="button" onclick="submitForm()" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </main>

    </div>


    <div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="doctorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctorModalLabel">Doctor Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalHospital"></p>
                    <p id="modalEmail"></p>
                    <p id="modalPassword"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="shareDoctorInfo()">Share</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function generatePassword() {
            const length = 12; // Length of the generated password
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+"; // Characters to include in the password
            let password = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            document.getElementById("password").value = password;
        }
// Submit form using AJAX
function submitForm() {
            const form = document.getElementById("addDoctorForm");
            const formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display doctor information in modal
                const hospital = document.querySelector("[name='hospital_id']").selectedOptions[0].innerText;
                const email = document.getElementById("useremail").value;
                const password = document.getElementById("password").value;

                document.getElementById("modalHospital").innerText = "Hospital: " + hospital;
                document.getElementById("modalEmail").innerText = "Email: " + email;
                document.getElementById("modalPassword").innerText = "Password: " + password;

                // Show modal
                var doctorModal = new bootstrap.Modal(document.getElementById('doctorModal'));
                doctorModal.show();
            })
            .catch(error => console.error('Error:', error));
        }

        // Share captured data
        function shareDoctorInfo() {
            const hospital = document.querySelector("[name='hospital_id']").selectedOptions[0].innerText;
            const email = document.getElementById("useremail").value;
            const password = document.getElementById("password").value;

            // Here you can implement your share functionality, like copying to clipboard or sending via email
            // For demonstration, let's just log the data to console
            console.log("Hospital: " + hospital);
            console.log("Email: " + email);
            console.log("Password: " + password);
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


</body>

</html>