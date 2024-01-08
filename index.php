<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Sensor Data</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to update sensor data from the server
            function updateSensorData() {
                $.ajax({
                    url: "server_endpoint_to_get_data.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log("Success: ", data);

                        // Update the HTML elements with sensor data from the server
                        $("#status").html("ENS160Status: " + (data.ENS160Status ? data.ENS160Status : "undefined"));
                        $("#aqi").html("Air Quality Index: " + (data.AQI ? data.AQI : "undefined"));
                        $("#tvoc").html("TVOC Concentration: " + (data.TVOC ? data.TVOC + " ppb" : "undefined"));
                        $("#eco2").html("CO2 Equivalent Concentration: " + (data.ECO2 ? data.ECO2 + " ppm" : "undefined"));
                        $("#temperature").html("Temperature: " + (data.Temperature ? data.Temperature + " °C" : "undefined"));
                        $("#pressure").html("Pressure: " + (data.Pressure ? data.Pressure + " ppm" : "undefined"));
                        $("#humidity").html("Humidity: " + (data.Humidity ? data.Humidity + " %" : "undefined"));
                        $("#gasresistance").html("Gas Resistance: " + (data.GasResistance ? data.GasResistance + " Ohms" : "undefined"));

                        // Optional: Store the latest data globally for other functions to access
                        window.latestSensorData = data;
                    },
                    error: function (xhr, status, error) {
                        console.log("Error fetching sensor data: " + error);
                        console.log("xhr: ", xhr);
                        console.log("status: ", status);
                    }
                });
            }

            // Fetch and display sensor data initially
            updateSensorData();

            // Update sensor data every 1 seconds (or adjust the interval as needed)
            setInterval(updateSensorData, 1000);
        });
    </script>
</head>
<body>
    <h1>Real-time Sensor Data</h1>
    <div id="status"></div>
    <div id="aqi"></div>
    <div id="tvoc"></div>
    <div id="eco2"></div>
    <div id="temperature"></div>
    <div id="pressure"></div>
    <div id="humidity"></div>
    <div id="gasresistance"></div>
</body>
</html>
