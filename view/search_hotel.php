<?php

$conn = mysqli_connect("localhost", "prince_sadariya", "deep70", "prince_sadariya3");
$hotelData = array();

$searchField = $_POST["searchBy"];

if (!empty($searchField)) {
    if ($searchField == "title" && !empty($_POST["searchBar"])) {
        $search = $_POST["searchBar"];
        $sql = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE hotel_title LIKE '%$search%' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $hotelData[] = $row;
        }
        // print_r($hotelData);
    } elseif ($searchField == "location" && !empty($_POST["searchBar"])) {
        $search = $_POST["searchBar"];
        $sql1 = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE location_name LIKE '%$search%' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
        $sql2 = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE location_city LIKE '%$search%' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
        $sql3 = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE location_state LIKE '%$search%' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";

        $res1 = mysqli_query($conn, $sql1);
        $res2 = mysqli_query($conn, $sql2);
        $res3 = mysqli_query($conn, $sql3);

        while ($row = mysqli_fetch_assoc($res1)) {
            $hotelData[] = $row;
        }
        while ($row = mysqli_fetch_assoc($res2)) {
            $hotelData[] = $row;
        }
        while ($row = mysqli_fetch_assoc($res3)) {
            $hotelData[] = $row;
        }

        // print_r($hotelData);
    } elseif ($searchField == "rating" && !empty($_POST["rating"])) {
        $rating = $_POST["rating"];
        $sql = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE hotel_star = '$rating' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $hotelData[] = $row;
        }
        // print_r($hotelData);
    } elseif ($searchField == "roomType" && !empty($_POST["roomType"])) {
        $roomType = $_POST["roomType"];
        $sql = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE room_type = '$roomType' AND hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $hotelData[] = $row;
        }
        // print_r($hotelData);
    }
} else {
    $sql = "SELECT * FROM hotels JOIN locations ON hotel_location_id = location_id WHERE hotels.deleted_date = '0000-00-00 00:00:00' AND hotels.status = '1'";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $hotelData[] = $row;
    }
}

$noResult = true;

foreach ($hotelData as $row) {
    $noResult = false;

    $addHtmlData .= '<div class=" my-4">
            <div class="row border border-2 bg-white py-1 px-3">
                <div class="col-md-4 d-flex gap-4 justify-content-center">
                    <a href="./hotel_details.php?hid=' . $row["hotel_id"] . '"><img src="../lib/images/' . $row["hotel_small_pic"] . '" alt="IMG" height="200" width="300"></a>
                    <div id="hrdiv"></div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                        <h3 class="text-primary"><a href="./hotel_details.php?hid=' . $row["hotel_id"] . '">' . $row["hotel_title"] . '</a></h3>
                            <p class="text-muted"><span class="fw-bold">Location :</span> ' . $row["location_name"] . ' , ' . $row["location_city"] . ' , ' . $row["location_state"] . '</p>
                            <p class="text-muted">' . $row["short_desc"] . '</p>
                            <p class="text-danger">5 people booked this property in the last 48 hours</p>
                        </div>

                        <div class="col-md-5 text-end">
                            <p><span class="fas fa-star text-warning"> </span> ' . $row["hotel_star"] . '/5</p>
                            <p class="text-primary my-0"> <span class="fw-bold"> Room Type : </span> ' . $row["room_type"] . '</p>
                            <p class="fs-3 my-0"><del>$98</del> $88</p>

                            <span class="text-primary bg-warning p-2"> <span class="fas fa-tags"></span> Get
                                member price</span>
                                <div class="mt-3">
                                    <a href="./hotel_details.php?hid=' . $row["hotel_id"] . '" class="btn btn-primary">View more</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}

if ($noResult) {
    echo '<div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">No results Found</h4>
            <p>Suggestions:
            <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</p></li>
            </ul>
        </div>';
} else {

    echo $addHtmlData;
}
