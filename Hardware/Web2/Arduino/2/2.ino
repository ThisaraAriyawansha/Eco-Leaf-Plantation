int ledPin = 13;

void setup() {
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT);
}

void loop() {
  if (Serial.available() > 0) {
    char command = Serial.read();
    Serial.print("Received command: ");
    Serial.println(command);
    
    if (command == '1') {
      digitalWrite(ledPin, HIGH);  // Turn on the LED
    } else if (command == '0') {
      digitalWrite(ledPin, LOW);   // Turn off the LED
    }
  }
}
