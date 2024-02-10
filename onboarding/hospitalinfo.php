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
        <form action="/project/dummy/partials/handelonboarding/__handelhospitalinfo.php" method="post">
            <div class="mb-3">
                <label for="hospitalname" class="form-label">Hospital Name</label>
                <input type="text" class="form-control" id="hospitalname" name="hospitalname">
            </div>
            <div class="mb-3">
                <label for="hospitaladdress" class="form-label">Hospital Address</label>
                <input type="text" class="form-control" id="hospitaladdress" name="hospitaladdress">
            </div>
            <div class="mb-3">
                <label for="hospitalcontactnum" class="form-label">Hospital Contact Number</label>
                <input type="tel" class="form-control" id="hospitalcontactnum" name="hospitalcontactnum">
            </div>
            <div class="mb-3">
                <label for="hospitalid" class="form-label">Hospital Id</label>
                <input type="text" class="form-control" id="hospitalid" name="hospitalid">
            </div>
            <div class="mb-3">
                <label for="hospitalimg" class="form-label">Hospital Image</label>
                <input type="file" class="form-control" id="hospitalimg" name="hospitalimg">
            </div>
            <div class="mb-3">
                <label for="hospitaldoc" class="form-label">Hospital documents</label>
                <input type="file" class="form-control" id="hospitaldoc" name="hospitaldoc">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


</body>

</html>