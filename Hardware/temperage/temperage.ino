#define TOUCH_PIN_1 4
#define TOUCH_PIN_2 2 
#define LED_PIN_1 12    
#define LED_PIN_2 13   
void setup() {
    Serial.begin(115200);

  pinMode(TOUCH_PIN_1, INPUT);
  pinMode(TOUCH_PIN_2, INPUT);
  pinMode(LED_PIN_1, OUTPUT);
  pinMode(LED_PIN_2, OUTPUT);
}

void loop() {
      digitalWrite(LED_PIN_2, LOW);
    digitalWrite(LED_PIN_1, LOW);

  int touchState1 = touchRead(4);
  int touchState2 = touchRead(2);

Serial.println(touchState1);
Serial.println(touchState2);



  if (touchState1 == HIGH) {
    digitalWrite(LED_PIN_1, HIGH);
  } 

  if (touchState2 == HIGH) {
    digitalWrite(LED_PIN_2, HIGH);
  } 
}
