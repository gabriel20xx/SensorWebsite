<?php

$arduinoIP = "192.168.2.250";
$arduinoEndpoint = "http://$arduinoIP/getSensorData";

// Make a request to the Arduino Uno for sensor data
$response = @file_get_contents($arduinoEndpoint);

// Check if the request was successful
if ($response !== false) {
    // Check if the HTTP status code is available
    $httpStatus = isset($http_response_header[0]) ? $http_response_header[0] : 'Unknown';

    if (strpos($httpStatus, '200') !== false) {
        $sensorData = json_decode($response, true);

        if ($sensorData !== null) {
            $status = $sensorData['status'];
            $AQI = $sensorData['AQI'];
            $TVOC = $sensorData['TVOC'];
            $ECO2 = $sensorData['ECO2'];

            // Do something with the individual sensor values
            echo "Status: $status<br>";
            echo "Air Quality Index: $AQI<br>";
            echo "TVOC Concentration: $TVOC ppb<br>";
            echo "CO2 Equivalent Concentration: $ECO2 ppm<br>";
        } else {
            echo "Error decoding sensor data JSON";
        }
    } else {
        echo "Error fetching sensor data. HTTP Status: $httpStatus";
    }
} else {
    echo "Failed to make the HTTP request to the Arduino";
}

?>
