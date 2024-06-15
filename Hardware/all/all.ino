#include <DHT.h>

#define DHTPIN 2    // Pin where the DHT11 is connected
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);


const int sensorPin = A0;
int soilMoistureValue;
int thresholdValue = 700;  // Set your threshold value
int motor1PWM = 9;    
int motor1DirA = 8;   
int motor1DirB = 7;    

int motor2PWM = 10;   
int motor2DirA = 11;   
int motor2DirB = 12;   


 // Analog pin for temperature sensor
const int fanPin = 13;         // Pin for the fan
const int ledPin = 6;          // Pin for the LED

const float temperatureThreshold = 28.0;

void setup() {
    Serial.begin(9600);
      dht.begin();


        pinMode(motor1PWM, OUTPUT);
      pinMode(motor1DirA, OUTPUT);
      pinMode(motor1DirB, OUTPUT);

      pinMode(motor2PWM, OUTPUT);
      pinMode(motor2DirA, OUTPUT);
      pinMode(motor2DirB, OUTPUT);
       pinMode(ledPin, OUTPUT);
}

void loop() {
     float temperature = dht.readTemperature();


    soilMoistureValue = analogRead(sensorPin);

    Serial.print("Soil Moisture: ");
    Serial.println(soilMoistureValue);

    if (soilMoistureValue < thresholdValue) {
        Serial.println("Soil is dry!");
        // Perform actions for dry soil
        turnOnPump();  // Call function to turn on the pump
    } else {
        Serial.println("Soil is moist or wet.");
        // Perform actions for moist or wet soil
        turnOffPump();  // Call function to turn off the pump
    }
  // Compare temperature and control fan and LED
  if (temperature > temperatureThreshold) {
    digitalWrite(motor2DirA, HIGH);
  digitalWrite(motor2DirB, LOW);
  analogWrite(motor2PWM, 255); 
    Serial.println("fan on led off");
                   Serial.println(temperature);

    digitalWrite(fanPin, HIGH);  // Turn on the fan
    digitalWrite(ledPin, LOW);   // Turn off the LED
  } else {
     digitalWrite(motor2DirA, LOW);
  digitalWrite(motor2DirB, LOW);
  analogWrite(motor2PWM, 255); 
        Serial.println("fan off led on");
               Serial.println(temperature);

    digitalWrite(fanPin, LOW);   // Turn off the fan
    digitalWrite(ledPin, HIGH);  // Turn on the LED
  }

    delay(1000);
}


void turnOnPump() {
     digitalWrite(motor1DirA, HIGH);
  digitalWrite(motor1DirB, LOW);
  analogWrite(motor1PWM, 255); 
    Serial.println("Water pump is ON.");
}

void turnOffPump() {
     digitalWrite(motor1DirA, LOW);
  digitalWrite(motor1DirB, LOW);
  analogWrite(motor1PWM, 255); 
    Serial.println("Water pump is OFF.");
}
