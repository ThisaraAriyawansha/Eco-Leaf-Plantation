// arduino/arduino_code.ino

int ledPin = 13; // LED connected to digital pin 13

void setup() {
  pinMode(ledPin, OUTPUT); // sets the digital pin as output
  Serial.begin(9600); // opens serial port, sets data rate to 9600 bps
}

void loop() {
  if (Serial.available()) { // if data is available to read
    char command = Serial.read(); // read it and store it in 'command'
    if (command == '1') {
      digitalWrite(ledPin, HIGH); // turn the LED on
    } else if (command == '0') {
      digitalWrite(ledPin, LOW); // turn the LED off
    }
  }
}
