<?php

// 1=>Please provide valid API token
// 2=>Please provide valid API token
// 3=>Data found
// 4=>Data not found

require_once 'Location.php';

header("Content-Type:application/json");


if (isset($_GET["token"])) {
    if ($_GET['token'] == 'aaaaabbbbb') {
        $locationObject = new Location();

        if (isset($_GET["location_id"])) {
            $locationId = $_GET["location_id"];

            $result = $locationObject->getLocations('*', ["location_id" => $locationId]);

            if (count($result) > 0) {
                $status = 'true';
                $data = $result[0];
                $code = '3';
            } else {
                $status = 'true';
                $data = 'Data not found';
                $code = '4';
            }
        } else {
            $result = $locationObject->getLocations();

            if (count($result) > 0) {
                $status = 'true';
                $data = $result;
                $code = '3';
            } else {
                $status = 'true';
                $data = 'Data not found';
                $code = '4';
            }
        }
    } else {
        $status = 'true';
        $data = 'Please provide valid API token';
        $code = '2';
    }
} else {
    $status = 'true';
    $data = 'Please provide API token';
    $code = '1';
}

echo json_encode(["status" => $status, "data" => $data, "code" => $code]);
