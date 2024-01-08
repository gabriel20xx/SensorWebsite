<?php

function fetchSensorDataFromArduino()
{
    // Your Arduino's endpoint URL
    $arduinoEndpoint = 'http://192.168.2.249/getSensorData';

    // Attempt to make the HTTP request
    $data = @file_get_contents($arduinoEndpoint);

    // Check for errors in the HTTP request
    if ($data === FALSE) {
        echo "Failed to retrieve data from Arduino.";
        // You may want to handle the error appropriately, e.g., log it, retry, etc.
    } else {
        if ($data === null) {
            echo "Failed to decode JSON data.";
            return false;
            // Handle the decoding error as needed
        } else {
            return $data;
        }
    }
}

// Function to store sensor data in a file
function storeSensorDataInFile($data)
{
    $filename = 'sensor_data.json';
    file_put_contents($filename, json_encode($data));
}

// Execute the loop every 1 second
$sensorData = fetchSensorDataFromArduino();
storeSensorDataInFile($sensorData);
echo $sensorData;

// Wait for 1 second before making the next request
sleep(1);
