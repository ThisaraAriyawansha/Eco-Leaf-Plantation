// Define the pin for the LDR
const int ldrPin = A0; // Analog pin for LDR

// Define the pin for the LED
const int ledPin = 13; // Built-in LED on most Arduino boards

void setup() {
  Serial.begin(9600); // Initialize serial communication
  pinMode(ldrPin, INPUT);
  pinMode(ledPin, OUTPUT);
}

void loop() {
  // Read the LDR value
  int ldrValue = analogRead(ldrPin);

  // Print the LDR value to the serial monitor
  Serial.print("LDR Value: ");
  Serial.println(ldrValue);

  // If the LDR value is less than 300, light up the LED
  if (ldrValue < 300) {
    digitalWrite(ledPin, HIGH); // Turn on the LED
  } else {
    digitalWrite(ledPin, LOW); // Turn off the LED
  }

  delay(1000); // Adjust the delay according to your needs
}
