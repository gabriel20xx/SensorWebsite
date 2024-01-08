<?php
session_start(); // Start the session

// Your Arduino's endpoint URL
$arduinoEndpoint = 'http://192.168.2.250/getSensorData';

// Function to fetch sensor data from Arduino
function fetchSensorDataFromArduino() {
    $data = file_get_contents($GLOBALS['arduinoEndpoint']);
    return json_decode($data, true);
}

// Function to store sensor data in a session variable
function storeSensorDataInSession($data) {
    $_SESSION['latestSensorData'] = $data;
}

// Fetch and store sensor data
$sensorData = fetchSensorDataFromArduino();
storeSensorDataInSession($sensorData);

// Echo the latest stored sensor data (for demonstration purposes)
if (isset($_SESSION['latestSensorData'])) {
    echo json_encode($_SESSION['latestSensorData']);
} else {
    echo json_encode(['error' => 'Sensor data not available']);
}
?>
