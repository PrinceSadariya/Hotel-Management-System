<?php

require './__check_login.php';
require_once '../../controller/Location.php';


$isValid = true;
//ASSIGN NULL VALUE FOR ERROR HANDLING
$locationNameOld = null;
$locationCityOld = null;
$locationStateOld = null;

$heading = "Add New Location";
if (isset($_GET["editid"])) {
    // For Updating Data

    $heading = "Edit Location";
    $editId = $_GET["editid"];

    $locationObject = new Location();

    $locationData = $locationObject->getLocations('*', ["location_id" => $editId]);
    $locationNameOld = $locationData[0]["location_name"];
    $locationCityOld = $locationData[0]["location_city"];
    $locationStateOld = $locationData[0]["location_state"];
}
if (isset($_POST["editId"])) {

    if ($_POST["editId"] != '') {
        //FOR UPDATE LOCATION

        $url = SITE_URL . "api/edit.php?token=aaaaabbbbb";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);

        $result = curl_exec($curl);
        $result = json_decode($result, true);

        curl_close($curl);

        if ($result['code'] == '4') {
            $updateMsg = true;
        }
    }
    if ($_POST["editId"] == '') {
        // For insert Location

        $url = SITE_URL . "api/create.php?token=aaaaabbbbb";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);

        $result = curl_exec($curl);
        $result = json_decode($result, true);

        curl_close($curl);

        if ($result['code'] == '3') {
            $insertMsg = true;
        }
    }
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../lib/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</head>

<body>
    <?php include './__header.php';
    ?>
    <?php include './__sidebar.php';
    ?>

    <div class="container">
        <div id="msgInsert">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data has been inserted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div id="msgUpdate">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data has been updated
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div class="mb-4">
            <h1 class="text-center"><?php echo $heading; ?></h1>
        </div>
        <div>
            <form id="locationForm" action="javascript:void(0)" method="POST" onsubmit="validateLocation(this)">
                <div class="row mb-3">
                    <div class="col-md-3 text-end">

                        <label for="locationName" class="form-label">Enter Location Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" id="editId" name="editId" value="<?php if (isset($editId)) {
                                                                                    echo $editId;
                                                                                }  ?>">
                        <input type="text" name="locationName" id="locationName" class="form-control" value="<?php echo $locationNameOld; ?>">
                        <span id="locationNameErr" class="form-text text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">

                        <label for="locationCity" class="form-label">Enter City <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">

                        <input type="text" name="locationCity" id="locationCity" class="form-control" value="<?php echo $locationCityOld; ?>">
                        <div id="locationCityErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">

                        <label for="locationState" class="form-label">Enter State <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">

                        <input type="text" name="locationState" id="locationState" class="form-control" value="<?php echo $locationStateOld; ?>">
                        <div id="locationStateErr" class="form-text text-danger"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 text-end">

                    </div>
                    <div class="col-md-9">
                        <?php
                        if (isset($_GET['editid'])) {
                        ?>
                            <input type="submit" value="Update" name="submit" id="btnsubmit" class="btn btn-primary">
                        <?php
                        } else {
                        ?>
                            <input type="submit" value="Add" name="submit" id="btnsubmit" class="btn btn-primary">
                        <?php
                        }
                        ?>

                        <a href="./manage_location.php" class="btn btn-danger ms-2">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../lib/js/insert_location.js"></script>

</body>

</html>