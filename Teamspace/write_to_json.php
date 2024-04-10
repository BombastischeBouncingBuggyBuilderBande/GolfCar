<?php
$jsonData = file_get_contents('php://input');

$filePath = 'C:\xampp\htdocs\Golfcar\Teamspace\state.json';
$writeResult = file_put_contents($filePath, $jsonData);

if ($writeResult !== false) {
    http_response_code(200);
    echo 'JSON file updated successfully!';
} else {
    http_response_code(500);
    echo 'Failed to update JSON file. Error writing to file.';
}





