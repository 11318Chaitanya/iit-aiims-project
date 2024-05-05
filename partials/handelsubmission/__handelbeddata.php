<?php    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include "../__dbconnect.php";

        session_start();

        $postType = $_POST["datauploadtype"];
        echo "$postType";

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

        if($postType === "manu"){
            $bedNum = $_POST['bednum'];
            $bedType = $_POST['bedtype'];
            $bedAvailibility = $_POST['bedavilibility'];

            for($i=0;$i<count($bedNum);$i++){
                $sql = "INSERT INTO `bedinfo` (`bed_num`, `bed_type`, `bed_availibility`, `hospital_id`, `tstamp`) VALUES ('$bedNum[$i]', '$bedType[$i]', '$bedAvailibility[$i]', '$hospital_id', current_timestamp())";
                $result = mysqli_query($conn, $sql);
            }
        }
        else if($postType === "ucsvf"){
            $fileName = $_FILES["beddatadoc"]["tmp_name"];

            if($_FILES["beddatadoc"]["size"] > 0) {
                $file = fopen($fileName, "r");

                // Displaying the headers
                $header = fgetcsv($file, 1000, ",");
                // echo "<p><strong>CSV Headers:</strong> " . implode(", ", $header) . "</p>";

                // Displaying each row
                // echo "<p><strong>CSV Data:</strong></p>";
                while(($column = fgetcsv($file, 1000, ",")) !== FALSE) {
                    // echo "<p>" . implode(", ", $column) . "</p>";

                    // Explode each column of the row
                    $parts = array_map('trim', explode(";", implode(";", $column)));
                    
                    // Inserting data into the database
                    $sql = "INSERT INTO `bedinfo` (`bed_num`, `bed_type`, `bed_availibility`, `hospital_id`, `tstamp`) 
                            VALUES ('" . $parts[0] . "', '" . $parts[1] . "', '" . $parts[2] . "', '$hospital_id', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    // if($result){
                    //     echo "success";
                    // }
                }
            }
        }
        
        header('location: /project/healthcarepro/main/dashboard.php');
        
        // echo json_encode($bedNum);
        // echo json_encode($bedType);
        // echo json_encode($bedAvailibility);

    }
?>