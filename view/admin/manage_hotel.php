<?php
require './__check_login.php';
require_once '../../controller/Hotel.php';

$delMsg = false;

if (isset($_GET["delid"])) {
    $delid = $_GET["delid"];

    $hotelObj = new Hotel();
    $hotelData = $hotelObj->getHotels('*', ["hotel_id" => $delid]);
    $smallImg = $hotelData[0]["hotel_small_pic"];
    $largeImg = $hotelData[0]["hotel_large_pic"];

    unlink("../../lib/images/" . $smallImg);
    unlink("../../lib/images/" . $largeImg);

    $delMsg = $hotelObj->deleteHotel($delid);
}

//FOR STATUS SWITCH
if (isset($_POST["status"])) {
    $status = $_POST["status"];
    $hotelId = $_POST["hid"];

    $queryObj = new Query();
    $updated = $queryObj->updateData("hotels", ["status" => $status], ["hotel_id" => $hotelId]);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="../../lib/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>

<body>
    <?php include './__header.php'; ?>
    <?php include './__sidebar.php'; ?>

    <div class="container">
        <?php
        if ($delMsg) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Hotel Has been deleted
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        ?>
        <div class="mb-4">
            <h1 class="text-center">List of Hotels</h1>
        </div>
        <div class="mb-4 text-end">
            <a href="./insert_hotel.php" class="btn btn-primary"><span class="fas fa-plus"></span> Add New Hotel</a>
        </div>
        <div class="mb-4">
            <div class="table-responsive">
                <table id="hotelTable" class="table table-light table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Short Description</th>
                            <th>Long Description</th>
                            <th>Rating / 5</th>
                            <th>Number of Rooms</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Register Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        $conn = mysqli_connect("localhost", "prince_sadariya", "deep70", "prince_sadariya3");

                        $query = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE hotels.deleted_date = '0000-00-00 00:00:00'";

                        $res = mysqli_query($conn, $query);

                        if ($res) {
                            $i = 1;

                            while ($row = mysqli_fetch_assoc($res)) {
                                $status = "Inactive";
                                $color = "text-danger";
                                $switchBtn = '<div class="form-check form-switch">
                                             <input class="statusSwitch form-check-input" type="checkbox" role="switch" id="statusSwitch' . $row["hotel_id"] . '">
                                        </div>';
                                if ($row["status"] == "1") {
                                    $status = "Active";
                                    $color = "text-success";
                                    $switchBtn = '<div class="form-check form-switch">
                                                    <input class="statusSwitch form-check-input" type="checkbox" role="switch" id="statusSwitch' . $row["hotel_id"] . '" checked>
                                                 </div>';
                                }
                                echo ' <tr>
                                        <td>' . $i++ . '.</td>
                                        <td>' . $row["hotel_title"] . '<br><img width="100" height="100" class="mt-3" src="../../lib/images/' . $row["hotel_small_pic"] . '" alt=""></td>
                                        <td>' . $row["location_name"] . ' , ' . $row["location_city"] . ' , ' . $row["location_state"] . '</td>
                                        <td>' . $row["short_desc"] . '</td>
                                        <td>' . $row["long_desc"] . '</td>
                                        <td>' . $row["hotel_star"] . '</td>
                                        <td>' . $row["number_of_room"] . '</td>
                                        <td>' . $row["room_type"] . '</td>
                                        <td>' . $switchBtn . '</td>
                                        <td>' . date("d-m-Y", strtotime($row["hotel_register_date"])) . '</td>
                                        <td class="text-center"><span class="editbtn me-3 text-primary cursor-pointer fas fa-pen" id="e' . $row["hotel_id"] . '"></span><span id="d' . $row["hotel_id"] . '" class="delbtn text-danger cursor-pointer fas fa-trash"></button></td>
                                    </tr>';
                            }
                        }


                        ?> </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php include './__footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="../../lib/js/bootbox.js"></script>
    <script src="../../lib/js/manage_hotel.js"></script>
</body>

</html>