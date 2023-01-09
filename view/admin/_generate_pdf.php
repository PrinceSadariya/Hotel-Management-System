<?php

require '../../vendor/autoload.php';


require './__check_login.php';

require_once '../../controller/Location.php';
require_once '../../controller/Hotel.php';


$html = '
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
            <tbody class="table-group-divider">';

$url = SITE_URL . "api/read.php?token=aaaaabbbbb";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

$result = json_decode($result, true);

curl_close($ch);

$i = 1;
foreach ($result['data'] as $dt) {
    $html .= ' <tr>
                <td>' . $i++ . '.</td>
                <td>' . $dt["location_name"] . '</td>
                <td>' . $dt["location_city"] . '</td>
                <td>' . $dt["location_state"] . '</td>
             </tr>';
}
$html .= '
</tbody>
</table>';


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

// header('Location: manage_location.php');
