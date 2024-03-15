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
        <div>

            <div class="mb-3">
                <label for="uploadtype" class="form-label">Upload Method</label>
                <select class="form-select" aria-label="Default select example" name="uploadtype" id="uploadtype">
                    <option value="manu">Manually</option>
                    <option value="ucsvf">Upload CSV File</option>
                </select>
            </div>
            <div class="mb-3" id="manualgenerate">
                <div class="d-flex ">
                    <table class="table" id="bedGenTable">
                        <thead>
                            <tr>
                                <th scope="col">Number of beds</th>
                                <th scope="col">Bed Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" class="form-control" id="totalBedNumPerType">
                                </td>
                                <td>
                                    <!-- <input type="text" class="form-control" id="bedTypeName"> -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="General Ward">General Ward</option>
                                        <option value="Private Ward">Private Ward</option>
                                        <option value="Semi-Private Ward">Semi-Private Ward</option>
                                        <option value="ICU">ICU</option>
                                        <option value="CCU">CCU</option>
                                        <option value="Maternity Ward">Maternity Ward</option>
                                        <option value="Pediatric Ward">Pediatric Ward</option>
                                        <option value="Psychiatric Ward">Psychiatric Ward</option>
                                        <option value="Geriatric Ward">Geriatric Ward</option>
                                        <option value="Isolation Ward">Isolation Ward</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" onclick="bedTypeAddition()">Add Bed Types</button>
                <button type="button" class="btn btn-primary" onclick="generateTableRow()">Generate Table</button>
            </div>

        </div>

        <form action="/project/healthcarepro/partials/handelsubmission/__handelbeddata.php" method="post"
            enctype="multipart/form-data">
            <div class="dataTableContainer" id="dataTableContainer" style="display:none">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Bed No</th>
                            <th scope="col">Bed Type</th>
                            <th scope="col">Availibility</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary" onclick="generateTableRow()">Add Bed</button>
                        <button type="button" class="btn btn-danger" onclick="removeLastRow()">Remove Bed</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <input type="text" name="datauploadtype" id="datauploadtype" value="manu" hidden>
            <div class="fileSubContainer" id="fileSubContainer" style="display:none">
                <div class="mb-3">
                    <label for="beddatadoc" class="form-label">Upload CSV File</label>
                    <input type="file" class="form-control" id="beddatadoc" name="beddatadoc">
                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </div>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    let uploadtype = document.getElementById('uploadtype');
    uploadtype.addEventListener('change', (e) => {
        if (e.target.value == 'manu') {
            document.getElementById('manualgenerate').style.display = 'block';
            document.getElementById('fileSubContainer').style.display = 'none';
            document.getElementById('datauploadtype').value = "manu";
            // document.getElementById('uploadForm').setAttribute('action', `/project/healthcarepro/partials/handelsubmission/__handelbeddata.php?uploadtype=${e.target.value}`);
        } else if (e.target.value == 'ucsvf') {
            document.getElementById('fileSubContainer').style.display = 'block';
            document.getElementById('manualgenerate').style.display = 'none';
            document.getElementById('datauploadtype').value = "ucsvf";
            // document.getElementById('uploadForm').setAttribute('action', `/project/healthcarepro/partials/handelsubmission/__handelbeddata.php?uploadtype=${e.target.value}`);
            let dataTableContainer = document.getElementById('dataTableContainer');
            dataTableContainer.style.display = 'none';
        }
        // let actionUrl = "/project/healthcarepro/partials/handelsubmission/__handelbeddata.php?uploadtype=" + e.target.value;
        // document.getElementById('uploadForm').setAttribute('action', actionUrl);
    });

    
    function generateTableRow() {
        let sno = 1;
        let table = document.getElementById('myTable');
        let dataTableContainer = document.getElementById('dataTableContainer');
        dataTableContainer.style.display = 'block';
        let tbody = table.getElementsByTagName('tbody')[0];
        tbody.innerHTML = '';
        let bedTypes = document.querySelectorAll('#bedGenTable tbody tr select');
        let allBedTypes = []; // Array to store all bed types

        // Gather all bed types
        bedTypes.forEach(bedType => {
            allBedTypes.push(bedType.value);
        });

        bedTypes.forEach(bedType => {
            let bedNum = bedType.parentElement.parentElement.querySelector('input[type="number"]').value;
            for (let i = 0; i < bedNum; i++) {
                let newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td scope="row"><input type="number" class="form-control" name="bednum[]" value="${sno}"></td>
                <td><select class="form-select" aria-label="Default select example" name="bedtype[]"></select></td>
                <td><select class="form-select" aria-label="Default select example" name="bedavilibility[]">
                        <option value="Available">Available</option>
                        <option value="Occupied">Occupied</option>
                    </select></td>
                <td><a href="#" class="btn btn-primary me-2">Edit</a><a href="#" class="btn btn-danger">Remove</a></td>
            `;

                // Append the new row to the tbody  
                tbody.appendChild(newRow);

                // Populate the bed type select element with all bed types
                let bedTypeSelect = newRow.querySelector('select[name="bedtype[]"]');
                allBedTypes.forEach(bedTypeValue => {
                    let option = document.createElement('option');
                    option.value = bedTypeValue;
                    option.textContent = bedTypeValue;
                    bedTypeSelect.appendChild(option);

                    // Check if the current option matches the value provided in the field
                    if (bedTypeValue === bedType.value) {
                        option.selected = true;
                    }
                });

                sno++;
            }
        });
    }




    function removeLastRow() {
        let table = document.getElementById('myTable'); // Get the table element
        let tbody = table.getElementsByTagName('tbody')[0]; // Get the tbody element

        let lastRow = tbody.lastElementChild; // Get the last row (tr) element
        if (lastRow) { // Check if the last row exists
            tbody.removeChild(lastRow); // Remove the last row from the tbody
        }
    }

    function bedTypeAddition() {
        let table = document.getElementById('bedGenTable'); // Get the table element
        let tbody = table.getElementsByTagName('tbody')[0]; // Get the tbody element

        let newRow = document.createElement('tr'); // Create a new row element
        newRow.innerHTML = `
        <td>
            <input type="number" class="form-control" id="totalBedNumPerType">
        </td>
        <td>
            <select class="form-select" aria-label="Default select example">
                <option value="General Ward">General Ward</option>
                <option value="Private Ward">Private Ward</option>
                <option value="Semi-Private Ward">Semi-Private Ward</option>
                <option value="ICU">ICU</option>
                <option value="CCU">CCU</option>
                <option value="Maternity Ward">Maternity Ward</option>
                <option value="Pediatric Ward">Pediatric Ward</option>
                <option value="Psychiatric Ward">Psychiatric Ward</option>
                <option value="Geriatric Ward">Geriatric Ward</option>
                <option value="Isolation Ward">Isolation Ward</option>
            </select>
        </td>
    `;

        // Append the new row to the tbody
        tbody.appendChild(newRow);


    }
    </script>

</body>

</html>