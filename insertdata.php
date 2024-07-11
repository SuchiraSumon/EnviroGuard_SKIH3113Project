<?php
// Establish a new database connection
$conn = mysqli_connect("localhost", "root", "", "projectskih3113");

// Fetch the latest 60 data points from the database for each sensor
$ir_valueresult = mysqli_query($conn, "SELECT sensor1 FROM sensordata ORDER BY sensordata.id DESC LIMIT 60");
$mq135_analog_valueresult = mysqli_query($conn, "SELECT sensor2 FROM sensordata ORDER BY sensordata.id DESC LIMIT 60");
$dht22_tempresult = mysqli_query($conn, "SELECT sensor3 FROM sensordata ORDER BY sensordata.id DESC LIMIT 60");
$dht22_humdresult = mysqli_query($conn, "SELECT sensor4 FROM sensordata ORDER BY sensordata.id DESC LIMIT 60");

// Initialize arrays to store the sensor data
$ir_value = [];
$mq135_analog_value = [];
$dht22_temp = [];
$dht22_humd = [];

// Fetch the temperature data from the database and store it in the temperatureData array
while($row = mysqli_fetch_array($s1result)){
    $ir_value[] = $row['sensor1'];
}

// Fetch the humidity data from the database and store it in the humidityData array
while($row = mysqli_fetch_array($s2result)){
    $mq135_analog_value[] = $row['sensor2'];
}

// Fetch the soil moisture data from the database and store it in the soilMoistureData array
while($row = mysqli_fetch_array($s3result)){
    $dht22_temp[] = $row['sensor3'];
}

// Fetch the soil moisture data from the database and store it in the soilMoistureData array
while($row = mysqli_fetch_array($s3result)){
    $dht22_humd[] = $row['sensor4'];
}

// Set the content type of the response to application/json
header('Content-Type: application/json');

// Encode the sensor data arrays as a JSON object and echo it as the response
echo json_encode([
    'ir_value' => $ir_value,
    'mq135_analog_value' => $mq135_analog_value,
    'dht22_temp' => $dht22_temp,
    'dht22_humd' => $dht22_humd
]);

?>