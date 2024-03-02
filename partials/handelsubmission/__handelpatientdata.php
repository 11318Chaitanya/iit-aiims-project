<?php    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include "../__dbconnect.php";

        session_start();

        $user_id = (int)$_SESSION['sno'];

        $patient_name = $_POST['patientname'];
        $patient_gender = $_POST['patientgender'];
        $patient_dob = $_POST['patientdob'];
        $patient_contact_num = $_POST['patientcontactnum'];
        $patient_adhar_num = $_POST['patientadharnum'];
        $patient_id = $_POST['patientid'];
        $patient_bp = $_POST['patientbp'];
        $patient_sugar = $_POST['patientsugar'];
        $patient_severity = $_POST['patientseverity'];
        $patient_diagnostic_text = $_POST['patientdiagnostictext'];
        $patient_medication_text = $_POST['patientmedicationtext'];
        $patient_medical_history = $_POST['patientmedicalhistory'];
        $doctor_comment = $_POST['doctorcomment'];

        // getting hospital id from doctor's (users) id 
        $sql = "SELECT * FROM `hospitalinfo` WHERE `user_id`='$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $hospital_id = $row['hospital_id'];

        // posting text data to database
        $sql_pdt = "INSERT INTO `patientinfo` (`patient_name`, `patient_gender`, `patient_dob`, `patient_contact_num`, `patient_adhar_num`, `patient_bp`, `patient_sugar`, `patient_severity`, `patient_diagnostic_text`, `patient_medication_text`, `patient_medical_history`, `doctor_comment`,`patient_id`, `hospital_id`, `user_id`, `tstamp`) VALUES ('$patient_name', '$patient_gender', '$patient_dob', '$patient_contact_num', '$patient_adhar_num', '$patient_bp', '$patient_sugar', '$patient_severity', '$patient_diagnostic_text', '$patient_medication_text', '$patient_medical_history' ,'$doctor_comment','$patient_id', '$hospital_id', '$user_id', current_timestamp())";

        $result_pdt = mysqli_query($conn, $sql_pdt);
        if($result_pdt){
            // patient images and videos
            foreach ($_FILES['patientimgvid']['name'] as $key => $value) {
                $pname = rand(11111111, 99999999) . "-" . $value;
                $tname = $_FILES['patientimgvid']['tmp_name'][$key];
                $upload_dir = "../../assests/patientfile";
                move_uploaded_file($tname, $upload_dir . '/' . $pname);
            }
            
            $patient_img_vid = serialize($_FILES['patientimgvid']['name']);
            
            // patient diagnostic files
            foreach ($_FILES['patientdiagnosticfile']['name'] as $key => $value) {

                $pname = rand(11111111, 99999999) . "-" . $value;
                $tname = $_FILES['patientdiagnosticfile']['tmp_name'][$key];
                $upload_dir = "../../assests/patientfile";
                move_uploaded_file($tname, $upload_dir . '/' . $pname);
            }
            
            $patient_diagnostic_file = serialize($_FILES['patientdiagnosticfile']['name']);
            
            // patient medication files
            foreach ($_FILES['patientmedicationfile']['name'] as $key => $value) {

                $pname = rand(11111111, 99999999) . "-" . $value;
                $tname = $_FILES['patientmedicationfile']['tmp_name'][$key];
                $upload_dir = "../../assests/patientfile";
                move_uploaded_file($tname, $upload_dir . '/' . $pname);
            }
            
            $patient_medication_file = serialize($_FILES['patientmedicationfile']['name']);

            $sql_pfd = "INSERT INTO `patientfile` (`patient_img_vid`, `patient_diagnostic_file`, `patient_medication_file`, `patient_id`, `tstamp`) VALUES ('$patient_img_vid', '$patient_diagnostic_file', '$patient_medication_file', '$patient_id', current_timestamp())";

            $result_pfd = mysqli_query($conn, $sql_pfd);
            if($result_pfd){
                header('location: /project/healthcarepro/main/addpatient.php?subSuccess=true');
            }

        }
        else {
            header('location: /project/healthcarepro/main/addpatient.php?subSuccess=false');
        }
        
        
    }
?>