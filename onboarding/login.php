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

    <?php
    
    if(isset($_GET['logSuccess']) && $_GET['logSuccess']=="false"){
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error! </strong>' .$_GET['error']. '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
    ?>


    <div class="container my-4 py-4">
        <h1 class="my-3">Login</h1>
        <form action="/project/dummy/partials/handelonboarding/__handelsignup.php" method="post">
            <div class="mb-3">
                <label for="usertype" class="form-label">User type</label>
                <select class="form-select" aria-label="Default select example" name="usertype">
                    <option selected disabled>Select User type</option>
                    <option value="ADM">Admin</option>
                    <option value="HOA">Hospital Admin</option>
                    <option value="DOC">Doctor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="useremail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="useremail" name="useremail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


</body>

</html>