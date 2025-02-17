<?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projectskih3113";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data in descending order based on the timestamp
    $sql = "SELECT * FROM sensordata ORDER BY timestamp DESC LIMIT 30";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "0 results";
    }

    echo json_encode($data);

    $conn->close();
?>