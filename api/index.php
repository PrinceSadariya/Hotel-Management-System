<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = SITE_URL . "api/read.php?token=aaaaabbbbb";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $arr['id'] = 72;
// $arr['locationName'] = "aaaasd";
// $arr['locationCity'] = "Amdaa";
// $arr['locationState'] = "Gujaaaaarat";

// curl_setopt($curl, CURLOPT_POSTFIELDS, $arr);

$result = curl_exec($curl);

$result = json_decode($result, true);

curl_close($curl);

echo $result['code'];

echo '<br>Prince<br>File: ' . __FILE__ . '<br>Line: ' . __LINE__ . '<br><pre>';
print_r($result);
echo '</pre>';
exit;
