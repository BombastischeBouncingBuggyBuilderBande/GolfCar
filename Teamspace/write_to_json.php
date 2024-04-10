<?php
$jsonData = file_get_contents('php://input');

// Use __DIR__ to get the directory of the current script.
// Then construct the path to the 'state.json' file relative to this script.
// This makes your script more flexible and portable.
$filePath = __DIR__ . '/state.json';

$writeResult = file_put_contents($filePath, $jsonData);

if ($writeResult !== false) {
    http_response_code(200);
    echo 'JSON file updated successfully!';
} else {
    http_response_code(500);
    echo 'Failed to update JSON file. Error writing to file.';
}
