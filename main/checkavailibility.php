<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assests/css/sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    main {
        overflow: auto;
    }
    </style>

</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php';?>
        <?php include '../partials/__dbconnect.php'?>

        <main class="d-flex flex-column mx-2">
            <div class="container my-2">
                <div class="d-flex">
                    <h1 class="my-3 me-auto">Hospital list:</h1>

                    <form class="d-flex my-3" method="get" action="checkavailibility.php" role="search">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <div class="row">
                    <?php
                    if(isset($_GET['search']) && $_GET['search'] != '') {
                    $sql_s = "SELECT * FROM `hospitalinfo` WHERE MATCH (hospital_name, hospital_id) against ('" . $_GET['search'] . "')";
                    $result_s = mysqli_query($conn, $sql_s);
                    $noresult = true;
                    while($row_s = mysqli_fetch_assoc($result_s)){
                        $hospitalName = $row_s['hospital_name'];
                        $hospitalAddress = $row_s['hospital_address'];
                        $hospitalContactNum = $row_s['hospital_contact_num'];
                        $hospitalImage = $row_s['hospital_img'];
                        
                        echo '<div class="col-md-4 my-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="../assests/hospitalimage/'.$hospitalImage.'" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href=""><i class="bi bi-hospital me-2 text-dark"></i>'.$hospitalName.'</a></h5>
                                        <p class="card-text"><i class="bi bi-geo-alt-fill me-2 "></i>' . substr($hospitalAddress, 0, 100) .'...</p>
                                        <p><i class="bi bi-telephone-fill me-2 "></i>'.$hospitalContactNum.'</p>
                                    </div>
                                </div>
                            </div>';
                        $noresult = false;
                    }
                    if($noresult){
                        echo "<div><h3>No results found</h3></div>";
                    }
                    echo '<hr>';
                    }


                    $sql = "SELECT * FROM `hospitalinfo`";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $hospitalName = $row['hospital_name'];
                            $hospitalAddress = $row['hospital_address'];
                            $hospitalContactNum = $row['hospital_contact_num'];
                            $hospitalImage = $row['hospital_img'];
                            
                            echo '<div class="col-md-4 my-2">
                                    <div class="card" style="width: 18rem;">
                                        <img src="../assests/hospitalimage/'.$hospitalImage.'" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href=""><i class="bi bi-hospital me-2 text-dark"></i>'.$hospitalName.'</a></h5>
                                            <p class="card-text"><i class="bi bi-geo-alt-fill me-2 "></i>' .$hospitalAddress .'</p>
                                            <p><i class="bi bi-telephone-fill me-2 "></i>'.$hospitalContactNum.'</p>
                                        </div>
                                    </div>
                                </div>';
                        }                   
                    ?>
                </div>
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