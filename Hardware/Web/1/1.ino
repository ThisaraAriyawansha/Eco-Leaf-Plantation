void setup() {
  Serial.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT);
}

void loop() {
  if (Serial.available() > 0) {
    char command = Serial.read();

    if (command == '1') {
      digitalWrite(LED_BUILTIN, HIGH); // Turn on the LED
      Serial.println("Light is ON");
    } else if (command == '0') {
      digitalWrite(LED_BUILTIN, LOW); // Turn off the LED
      Serial.println("Light is OFF");
    }
  }
  // Add other tasks as needed
}
