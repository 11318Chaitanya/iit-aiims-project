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

    <?php include '../partials/__header.php'; ?>


    <div class="container my-4 py-4">
        <form action="/project/dummy/partials/handelonboarding/__handeluserinfo.php" method="post"
            enctype="multipart/form-data">
            <div class="mb-3 d-flex">
                <img src="../assests/userdefault.jpg" alt="" width="200px" height="200px">
                <div class="mb-3 d-flex flex-column justify-content-center">
                    <label for="userpicture" class="form-label">Upload Profile picture</label>
                    <input type="file" class="form-control" id="userpicture" name="userpicture">
                </div>
            </div>
            <?php 
                session_start();
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                    $usertype = NULL;
                    if($_SESSION['usertype'] === "HOA"){
                        $usertype = "Hospital Admin";
                    }elseif($_SESSION['usertype'] === "DOC"){
                        $usertype = "Doctor";
                    }

                 echo '<div class="mb-3">
                        <label for="usertype" class="form-label">User type</label>
                        <select class="form-select" aria-label="Default select example" name="usertype">
                            <option selected disabled>'.$_SESSION['usertype'].'</option>
                        </select>
                        </div>';   
                }
            ?>

            <div class="mb-3">
                <label for="username" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label me-3">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_radio1" value="male">
                    <label class="form-check-label" for="gender_radio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_radio2" value="female">
                    <label class="form-check-label" for="gender_radio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_radio" value="others">
                    <label class="form-check-label" for="gender_radio3">Others</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="mobileNum" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="mobileNum" name="mobileNum">
            </div>
            <div class="mb-3">
                <label for="adharNum" class="form-label">AdharCard Number</label>
                <input type="number" class="form-control" id="adharNum" name="adharNum">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


</body>

</html>