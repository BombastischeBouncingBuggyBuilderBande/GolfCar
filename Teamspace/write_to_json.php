<?php
// Get the raw JSON data from the request body
$jsonData = file_get_contents('php://input');

// Log received JSON data (for debugging purposes)
file_put_contents('received_data.log', $jsonData . PHP_EOL, FILE_APPEND);

// Decode the JSON data
$decodedData = json_decode($jsonData, true);

// Check if decoding was successful
if ($decodedData !== null) {
    // Write the decoded JSON data back to the JSON file
    $filePath = 'Teamspace/state.json';
    $writeResult = file_put_contents($filePath, json_encode($decodedData, JSON_PRETTY_PRINT));

    if ($writeResult !== false) {
        // Send a success response
        http_response_code(200);
        echo 'JSON file updated successfully!';
    } else {
        // Send a failure response if file writing failed
        http_response_code(500);
        echo 'Failed to update JSON file. Error writing to file.';
    }
} else {
    // Send a failure response if JSON decoding failed
    http_response_code(400);
    echo 'Failed to update JSON file. Invalid JSON data received.';
}
?>
