<?php 

require_once 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$options = new QROptions([
        'version'    => 40, // QR code version (1-40)
        'outputType' => QRCode::OUTPUT_IMAGE_PNG, // Output format (e.g., PNG, SVG, JPG)
        'eccLevel'   => QRCode::ECC_H, // Error Correction Level (L, M, Q, H)
        'scale'      => 10, // Scale of the QR code modules in pixels
        'quietzoneSize' => 4, // Size of the quiet zone around the QR code
        'imageBase64' => false, // Set to true to output as base64 data URI
    ]);
$qrcode = new QRCode($options);

$filename = "temp.csv"; 
$delimiter = ",";     
$enclosure = "\"";    
$escape = "\\";
$baseurl = "https://mpoweredclass.com/"; 

$handle = fopen($filename, 'r');
if ($handle !== FALSE) { 
    while (($data = fgetcsv($handle, 0, $delimiter, $enclosure, $escape)) !== FALSE) { 
        $alength = count($data); 
        $url = $baseurl . "/" . $data[0] ."/" . $data[1] . "/" . $data[2] . "/"; 
        print_r($url);
        $qr_file_name = $data[0]. '-'. $data[1] . '-'. $data[2]. '.png';
        $qrcode->render($url, $qr_file_name);
   }
} else {
    print_r("Error in reading file"); 
}