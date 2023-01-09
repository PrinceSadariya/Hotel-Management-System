<?php


require './__check_login.php';

require_once '../../controller/Location.php';
require_once '../../controller/Hotel.php';


$delFalse = false;
$delTrue = false;

// For Delete location

if (isset($_GET["delid"])) {

    $delid = $_GET["delid"];

    $hotelObj = new Hotel();

    $hotelData = array();
    $hotelData = $hotelObj->getHotels('hotel_location_id', ["hotel_location_id" => $delid]);

    if ($hotelData == 0) {
        $url = SITE_URL . "api/delete.php?token=aaaaabbbbb";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $arr['id'] = $delid;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        curl_close($ch);

        if ($result["code"] == 4) {
            $delTrue = true;
        }
    } else {
        $delFalse = true;
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
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../lib/css/style.css">
</head>

<body>
    <?php include './__header.php'; ?>
    <?php
    if ($delFalse) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        This Location can not be deleted, Because hotels are allocated under this location 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($delTrue) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Location Has been deleted
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } ?>
    <?php include './__sidebar.php'; ?>
    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">List of Locations</h1>
        </div>
        <div class="mb-4 text-end">
            <a href="./insert_location.php" class="btn btn-primary"><span class="fas fa-plus"></span> Add New Location</a>
        </div>
        <div class="mb-4">
            <div class="table-responsive">
                <table id="locationTable" class="table table-light table-bordered">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Location Name</th>
                            <th>Location City</th>
                            <th>Location State</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                    </tbody>
                </table>
            </div>
            <div class="text-end mt-3">
                <a href="./generate_pdf.php" class="btn btn-outline-success">Generate PDF</a>
            </div>
        </div>
    </div>

    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="../../lib//js/bootbox.js"></script>
    <script src="../../lib/js/manage_location.js"></script>
</body>

</html>