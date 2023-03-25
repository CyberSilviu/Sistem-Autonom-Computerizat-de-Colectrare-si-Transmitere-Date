#include <L298N.h>
#include <NewPing.h>                   //adauga libraria "NewPing" ( libraria senzorului ) in program ;
#define trigPin D8                    // defineste PIN-ul 12 sub denumriea de "trig"; 
#define echoPin D7                      // defineste PIN-ul 11 sub denumriea de "echo";
                      // defineste distanta maxima ce va fi detectata de senzor;

long duration; // variable for the duration of sound wave travel
int distance; // variable for the distance measurement
/* motorul A */
int enA = D1;                           // motor A; initializeaza "enA" ca fiind PIN-ul 9;
int in1 = D5;                           // initializeaza "in1" ca fiind PIN-ul 5;
int in2 = D4;                           // initializeaza "in2" ca fiind PIN-ul 4;
L298N motorA(enA, in1, in2); // 
/* motorul B */
int enB = D0;                           // motor B; initializeaza "enB" ca fiind PIN-ul 6;
int in3 = D3;                           // initializeaza "in3" ca fiind PIN-ul 3;
int in4 = D2;                           // initializeaza "in4" ca fiind PIN-ul 2;
L298N motorB(enB, in3, in4);
                          // initializeaza "in4" ca fiind PIN-ul 2;
NewPing sonar(trigPin, echoPin);       // defineste PIN-urile conectate la senzor;



void setup() {                         // seteaza toate PIN-urile motorului ca iesire (OUTPUT);
  pinMode(enA, OUTPUT);
  pinMode(enB, OUTPUT);
  pinMode(in1, OUTPUT);
  pinMode(in2, OUTPUT);
  pinMode(in3, OUTPUT);
  pinMode(in4, OUTPUT);
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an OUTPUT
  pinMode(echoPin, INPUT); // Sets the echoPin as an INPUT
  Serial.begin(9600);
}               // selecteaza canalul 115200 pentru " Serial Monitor" ;



void loop() {                           // tot ce este in interiorul "loop()" se va repeta la infinit;
  // Clears the trigPin condition
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  // Sets the trigPin HIGH (ACTIVE) for 10 microseconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  // Reads the echoPin, returns the sound wave travel time in microseconds                          // intarzie repetarea programului;
  duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  distance = duration * 0.034 / 2; // Speed of sound wave divided by 2 (go and back)
  // Displays the distance on the Serial Monitor
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");               // afiseaza in Serial Monitor "cm" ;                                                                                                  */

  if (distance > 40)                           // daca ( "if" ) distanta dintre senzor si obstacol e mai mica de 50 ;
  { digitalWrite(in1, HIGH);              // motorul A va merge in fata;
    digitalWrite(in2, LOW);
    analogWrite(enA, 200);              // seteaza viteza 100 din raza posibila 0~255;
    digitalWrite(in3, LOW);             // motorul B va merge in fata;
    digitalWrite(in4, HIGH);
    analogWrite(enB, 200);
  }              // seteaza viteza 100 din raza posibila 0~255;

  else {                               // altfel;  Asta va face ca robotul sa isi schimbe directia de mers;
    // motorul A va merge in fata;
    digitalWrite(in1, HIGH);              // motorul A va merge in fata;
    digitalWrite(in2, LOW);
    analogWrite(enA, 200);             // seteaza viteza 100 din raza posibila 0~255;

    digitalWrite(in3, HIGH);
    digitalWrite(in4, LOW);
    analogWrite(enB, 200);
  }            // seteaza viteza 100 din raza posibila 0~255;

}
