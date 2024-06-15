#include <WiFi.h>
#include <ESPAsyncWebServer.h>
#include <DHT.h> // Include the DHT library
#include <ESP32Servo.h>

const char *ssid = "MSI";
const char *password = "0000000000";

const int ledPin = 4;  // GPIO pin connected to the LED
const int servoPin = 5; // GPIO pin connected to the servo
bool ledState = LOW;
int x=10;
// Define the type of DHT sensor and the pin it's connected to
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

Servo myServo;

AsyncWebServer server(80);

void setup() {
  Serial.begin(115200);

  pinMode(ledPin, OUTPUT);
  myServo.attach(servoPin);
  dht.begin(); // Initialize the DHT sensor

  connectToWiFi();

  // Display the IP address on the serial monitor
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  server.on("/", HTTP_GET, [](AsyncWebServerRequest *request){
    // Read temperature and humidity from the sensor
    float temperature = dht.readTemperature();
    float humidity = dht.readHumidity();

    // Print temperature and humidity values to the serial monitor
    Serial.print("Temperature: ");
    Serial.print(temperature);
    Serial.println(" °C");
    Serial.print("Humidity: ");
    Serial.print(humidity);
    Serial.println(" %");

    // Construct the HTML response with temperature and humidity data
    String htmlResponse = "<html>\
      <head>\
        <style>\
          body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }\
          button { padding: 10px 20px; font-size: 16px; margin: 10px; }\
        </style>\
      </head>\
      <body>\
        <h1>Controller Panel</h1>\
        <p>Temperature: ";
    htmlResponse += String(temperature);
    htmlResponse += "°C<br>Humidity: ";
    htmlResponse += String(humidity);
    htmlResponse += "%</p>\
        <button onclick=\"sendRequest('servo90')\">Open</button>\
        <button onclick=\"sendRequest('servo-90')\">Close</button>\
        <script>\
          function sendRequest(action) {\
            var xhr = new XMLHttpRequest();\
            xhr.open('GET', '/' + action, true);\
            xhr.send();\
          }\
        </script>\
      </body>\
    </html>";

    request->send(200, "text/html", htmlResponse);
  });

  server.on("/toggle", HTTP_GET, [](AsyncWebServerRequest *request){
    Serial.println("Received toggle request");
    toggleLED();
    request->send(200, "text/plain", "LED toggled");
  });

  server.on("/turnoff", HTTP_GET, [](AsyncWebServerRequest *request){
    Serial.println("Received turnoff request");
    turnOffLED();
    request->send(200, "text/plain", "LED turned off");
  });

  server.on("/servo90", HTTP_GET, [](AsyncWebServerRequest *request){
    Serial.println("Received servo90 request");
    if(x==180)
    {
          rotateServo(-180);
    }
    else
    {
    rotateServo(x);
    x=x+10;
    request->send(200, "text/plain", "Servo rotated to 90°");
    }
    
  });

  server.on("/servo-90", HTTP_GET, [](AsyncWebServerRequest *request){
    Serial.println("Received servo-90 request");
    rotateServo(-180);
    request->send(200, "text/plain", "Servo rotated to -90°");
  });

  server.begin();
}

void loop() {
  delay(2000); // Add a delay to prevent excessive processing
}

void toggleLED() {
  Serial.println("Toggling LED");
  ledState = !ledState;
  digitalWrite(ledPin, ledState);
}

void turnOffLED() {
  Serial.println("Turning off LED");
  ledState = LOW;
  digitalWrite(ledPin, ledState);
}

void rotateServo(int angle) {
  Serial.print("Rotating servo to ");
  Serial.print(angle);
  Serial.println(" degrees");
  myServo.write(angle);
}

void connectToWiFi() {
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}
