<?php


// 1=>Please provide valid API token
// 2=>Please provide valid API token
// 3=>Please provide locatoin id
// 4=>Location updated
// 5=>Error in updating location
// 6=>Incomplete Data


require_once 'Location.php';

header("Content-Type:application/json");


if (isset($_GET["token"])) {
    if ($_GET['token'] == 'aaaaabbbbb') {

        if (isset($_POST["editId"])) {
            extract($_POST);
            if (!empty($locationName) && !empty($locationCity) && !empty($locationState)) {
                $locationId = $_POST["editId"];

                $locationObject = new Location();

                $locationObject->setVariables($_POST);

                $result = $locationObject->updateLocation($locationId);

                if ($result) {
                    $status = 'true';
                    $data = 'Location updated';
                    $code = '4';
                } else {
                    $status = 'true';
                    $data = 'Error in updating location';
                    $code = '5';
                }
            } else {
                $status = true;
                $data = 'Incomplete data';
                $code = '6';
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
