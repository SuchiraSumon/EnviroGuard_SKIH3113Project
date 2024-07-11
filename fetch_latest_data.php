<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectskih3113";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ir_value, mq135_analog_value, dht22_temp, dht22_humd, timestamp FROM sensordata ORDER BY timestamp DESC LIMIT 20";
$result = $conn->query($sql);

$data = array();
$totals = ['mq135_analog_value' => 0, 'dht22_temp' => 0, 'dht22_humd' => 0];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        $totals['mq135_analog_value'] += $row['mq135_analog_value'];
        $totals['dht22_temp'] += $row['dht22_temp'];
        $totals['dht22_humd'] += $row['dht22_humd'];
    }
}

$latest_motion_value = $data[0]['ir_value'];

$averages = [
    'avg_mq135_analog_value' => $totals['mq135_analog_value'] / count($data),
    'avg_dht22_temp' => $totals['dht22_temp'] / count($data),
    'avg_dht22_humd' => $totals['dht22_humd'] / count($data),
    'latest_motion_value' => $latest_motion_value
];

echo json_encode(['data' => $data, 'averages' => $averages]);

$conn->close();
?>
