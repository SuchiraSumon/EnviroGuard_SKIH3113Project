  
  // Print WiFi connection details
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  dht.begin(); // Initialize DHT sensor

  // Initialize the IR sensor pin as input
  pinMode(IR_SENSOR_PIN, INPUT);
  // Initialize the MQ135 sensor pin as input
  pinMode(MQ135_PIN, INPUT);
}

void loop() {
  // Increment reading count
  readingCount++;

  // Read MQ135 sensor value
  int mq135_value = analogRead(MQ135_PIN);

  // Print the MQ135 value to the Serial Monitor
  Serial.print("MQ135 Sensor Value: ");
  Serial.println(mq135_value);

  delay(5000); // Delay 5 seconds between readings
  
  // Read IR sensor value
  int ir_value = digitalRead(IR_SENSOR_PIN);

  // Print the IR value to the Serial Monitor
  Serial.print("IR Sensor Value: ");
  ir_value = !ir_value; // Invert ir_value (0 becomes 1, and 1 becomes 0)
  Serial.println(ir_value);

  delay(5000); // Delay 5 seconds between readings

  // Read DHT22 sensor values
  float dht22_humd = dht.readHumidity(); // Read humidity
  float dht22_temp = dht.readTemperature(); // Read temperature

  // Check if any reads failed and exit early (to try again)
  if (isnan(dht22_humd) || isnan(dht22_temp)) {
    Serial.println("Failed to read from DHT sensor!");
    delay(5000);
    return; // Exit the loop early
  }
  
  // Print the DHT22 values to the Serial Monitor
  Serial.print("Humidity: ");
  Serial.print(dht22_humd);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(dht22_temp);
  Serial.println(" *C");

  delay(5000); // Delay 5 seconds between readings

  // Only send data after 30 readings
  if (readingCount > 30) {
    // Prepare data to send to PHP script
    String postData = "ir_value=" + String(ir_value) +
                      "&mq135_analog_value=" + String(mq135_value) +
                      "&dht22_temp=" + String(dht22_temp) +
                      "&dht22_humd=" + String(dht22_humd);

    // Send HTTP POST request to PHP script
    HTTPClient http; // Declare object of class HTTPClient
    WiFiClient wclient; // Declare object of class WiFiClient
    http.begin(wclient, serverUrl); // Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Specify content-type header

    // Send the actual POST request
    int httpResponseCode = http.POST(postData); 
    if (httpResponseCode > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode); // Print HTTP return code
      String response = http.getString(); // Get the response from the server
      Serial.println(response); // Print the response
    } else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode); // Print return code
    }

    http.end(); // Free resources
  } else {
    Serial.print("Skipping data transmission for initial readings: ");
    Serial.println(readingCount);
  }
}
