<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Scope | A Hotel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../lib/css/style.css">
    <style>
        .fas {
            font-size: 25px !important;
        }

        #hotel-detail {
            font-size: 20px;
        }

        .title-name {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include './__header.php'; ?>


    <?php


    if (isset($_GET["hid"])) {
        $hid = $_GET["hid"];


        $conn = mysqli_connect("localhost", "prince_sadariya", "deep70", "prince_sadariya3");

        $query = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE hotels.hotel_id = '$hid'";

        $res = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($res);

        echo '<div id="hotel-detail" class="container">
                <p class="text-center h2 my-4"><u>' . $row["hotel_title"] . '</u></p>
                <div class="container text-end">
                    <a href="./hotel_list.php" class="btn btn-outline-warning">Back</a>
                </div>
                <div class="img text-center">
                    <img src="../lib/images/' . $row["hotel_large_pic"] . '" alt="" height="500" width="700">
                </div>
                <div class="mt-3">
                    <p">' . $row["long_desc"] . '</p>
                </div>
                <div class="mt-3">
                    <p><span class="fw-bold fas fa-location-dot"></span><span class="title-name"> Location : </span>' . $row["location_name"] . ' , ' . $row["location_city"] . ' , ' . $row["location_state"] . '</p>
                </div>
                <div class="mt-3">
                    <p><span class="fw-bold fas fa-star"></span><span class="title-name"> Rating : </span>' . $row["hotel_star"] . ' / 5</p>
                </div>
                <div class="mt-3">
                    <p><span class="fw-bold fas fa-building"></span><span class="title-name"> Total Rooms : </span> ' . $row["number_of_room"] . ' </p>
                </div>
                <div class="mt-3">
                    <p><span class="fw-bold fas fa-list-check"></span><span class="title-name"> Room Type : </span>' . $row["room_type"] . ' </p>
                </div>
                <div class="mt-3">
                    <p><span class="fw-bold fas fa-calendar-days"></span><span class="title-name"> Hotel Register Date : </span>' . date("d-m-Y", strtotime($row["hotel_register_date"])) . ' </p>
                </div>
                
            </div>';
    }

    ?>


    <?php include './__footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>