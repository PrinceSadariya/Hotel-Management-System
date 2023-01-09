<?php


// 1=>Please provide valid API token
// 2=>Please provide valid API token
// 3=>Please provide locatoin id
// 4=>Location deleted
// 5=>Error in deleting location


require_once 'Location.php';

header("Content-Type:application/json");


if (isset($_GET["token"])) {
    if ($_GET['token'] == 'aaaaabbbbb') {
        $locationObject = new Location();

        if (isset($_POST["id"])) {
            $locationId = $_POST["id"];

            $result = $locationObject->deleteLocation($locationId);

            if ($result) {
                $status = 'true';
                $data = 'Location deleted';
                $code = '4';
            } else {
                $status = 'true';
                $data = 'Error in deleting location';
                $code = '5';
            }
        } else {
            $status = 'true';
            $data = 'Please provide location id';
            $code = '3';
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
