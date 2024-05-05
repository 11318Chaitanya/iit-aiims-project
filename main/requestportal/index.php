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


        <main class="d-flex flex-column mx-2">
            <h1 class="my-2 mx-2">Request Portal</h1>
            <section class="section my-2 py-2 px-4">
                <div class="row justify-content-evenly">
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">View Requests</h5>
                            <p class="card-text">View other hospital requests</p>
                            <a href="/project/healthcarepro/main/requestportal/viewrequest.php"
                                class="card-link">View</a>
                        </div>
                    </div>
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">Your Reqeusts</h5>
                            <p class="card-text">View your request status</p>
                            <a href="/project/healthcarepro/main/requestportal/viewrequested.php"
                                class="card-link">View</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section my-2 py-2 px-4">
                <div class="row justify-content-evenly">
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">Request Bed</h5>
                            <p class="card-text">Request hospital admin to allot bed for patient/patients</p>
                            <a href="/project/healthcarepro/main/requestportal/requestbed.php" class="card-link">Request
                                Bed</a>
                        </div>
                    </div>
                    <div class="card col-5">
                        <div class="card-body">
                            <h5 class="card-title">Request Patient Information</h5>
                            <p class="card-text">Request hospital admin or doctor to get patient information</p>
                            <a href="/project/healthcarepro/main/requestportal/requestpatientinfo.php"
                                class="card-link">Request Info</a>
                        </div>
                    </div>
                </div>
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