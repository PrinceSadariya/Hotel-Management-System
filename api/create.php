<?php


// 1=>Please provide valid API token
// 2=>Please provide valid API token
// 3=>Location inserted
// 4=>Error in inserting location
// 5=>Incomplete Data



require_once 'Location.php';

header("Content-Type:application/json");


if (isset($_GET["token"])) {
    if ($_GET['token'] == 'aaaaabbbbb') {
        extract($_POST);
        if (!empty($locationName) && !empty($locationCity) && !empty($locationState)) {

            $locationObject = new Location();

            $locationObject->setVariables($_POST);

            $result = $locationObject->insertLocation();

            if ($result) {
                $status = 'true';
                $data = 'Location inserted';
                $code = '4';
            } else {
                $status = 'true';
                $data = 'Error in inserting location';
                $code = '5';
            }
        } else {
            $status = 'true';
            $data = 'Incomplete data';
            $code = '6';
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
