#include <Servo.h>
#define LED 13
#define SELECTION_SERVO 10
#define MOTOR_A 9
#define MOTOR_B 5

volatile int ledOut = false;
void motorForward() {
  digitalWrite(9, HIGH);
  digitalWrite(MOTOR_B, LOW);
}
void motorBackward() {
  digitalWrite(9, LOW);
  digitalWrite(MOTOR_B, HIGH);
}
void motorHalt() {
  digitalWrite(9, LOW);
  digitalWrite(MOTOR_B, LOW);
}

enum states { IDLE, WHITE, FIRST_PULSED, PULSING1, PULSING2, VALIDATED, CRUSHING_START, CRUSHING_HALT, CRUSHING_STOP, CRUSHING_X } state = IDLE;
unsigned long pulseTime = 0;
unsigned long lastPulseStart = 0;
void processState(short pinInput, unsigned long pWidth) {
  switch(state) {
    case IDLE:
        state = pinInput ? WHITE : IDLE;
        break;
    case WHITE:
        state = pinInput ? WHITE : FIRST_PULSED;
        break;
    case FIRST_PULSED:
        state = pinInput ? PULSING1 : FIRST_PULSED;
        break;
    case PULSING1:
        state = pinInput ? PULSING2 : PULSING1;
        lastPulseStart = millis();
        break;
    case PULSING2: 
        state = PULSING1;
    case VALIDATED:
        break;
  }
}
void sensorChange() {
  short rPin = digitalRead(2);
  if(rPin==0) { // FALL 
      pulseTime = 0;
  }
  processState(rPin, millis()-pulseTime);
  pulseTime = millis();
  ledOut = ~ledOut;
  digitalWrite(13, ledOut);
}



SIGNAL(TIMER0_COMPA_vect) {
  
  if(state==PULSING2) { 
    unsigned long currentMillis = millis();  
    if(currentMillis-lastPulseStart>=200) {
      state = VALIDATED;
      lastPulseStart = millis();
    }
  }else if(state==VALIDATED) {
     unsigned long currentMillis = millis();
     if(currentMillis-lastPulseStart>=1000) {
        state=CRUSHING_START;
        lastPulseStart=millis();
     }
  }else if(state==CRUSHING_START) {
     unsigned long currentMillis = millis();
     if(currentMillis-lastPulseStart>=1500) {
        state=CRUSHING_HALT;
        lastPulseStart=millis();
     }
  }else if(state==CRUSHING_HALT) {
     unsigned long currentMillis = millis();
     if(currentMillis-lastPulseStart>=1500) {
        state=CRUSHING_STOP;
        lastPulseStart=millis();
     }
  }if(state==CRUSHING_STOP) {
     unsigned long currentMillis = millis();
     if(currentMillis-lastPulseStart>=1700) {
        state=CRUSHING_X;
        lastPulseStart=millis();
     }
  }
}

Servo myServo;
void setup() {
  pinMode(LED, OUTPUT);
  pinMode(MOTOR_A, OUTPUT);
  pinMode(MOTOR_B, OUTPUT);
  pinMode(2, INPUT);
  myServo.attach(10);
  
  OCR0A = 0xFE;
  TIMSK0 |= _BV(OCIE0A);
  Serial.begin(9600);
  
  digitalWrite(13, LOW);
  motorHalt();
  attachInterrupt(digitalPinToInterrupt(2),sensorChange, CHANGE);
  myServo.write(90);
  state = IDLE;
}
bool sal_campean = true;

void loop() {
  
  switch(state) {
    case IDLE:
    case WHITE: 
    case PULSING1: 
        digitalWrite(LED, 0);
        digitalWrite(6,1);
        digitalWrite(7,0);
        break;
    case PULSING2: 
        digitalWrite(LED, 1);
        break;
    case VALIDATED:
        digitalWrite(LED, 1);
        digitalWrite(6,0);
        digitalWrite(7,1);
        myServo.write(175);
        break;
    case CRUSHING_START:
        digitalWrite(LED, 0);
        motorForward();
        break;
    case CRUSHING_HALT:
        digitalWrite(LED, 1);
        motorHalt();
        break;
    case CRUSHING_STOP:
        digitalWrite(LED, 0);
        motorBackward();
        myServo.write(90);
        
        if(sal_campean){
          sal_campean=false;
          Serial.println("1");
        }
        break;
    case CRUSHING_X:
        digitalWrite(LED, 1);
        motorHalt();
        break;
  }
  
  /*myServo.write(90);
  delay(1000);
  myServo.write(0);
  delay(1000);
  myServo.write(180);
  delay(1000);*/
  /*motorForward();
  delay(100);
  motorHalt();
  delay(1000);
  motorBackward();
  delay(100);
  motorHalt();
  delay(1000);*/
}
