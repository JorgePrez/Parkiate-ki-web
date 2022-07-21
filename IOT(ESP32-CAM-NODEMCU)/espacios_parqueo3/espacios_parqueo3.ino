
#include <ESP8266WiFi.h>   //node mcu


#include "FirebaseESP8266.h"



//Firebase settings
 #define project "parkiate-ki-default-rtdb.firebaseio.com"
#define secret "zofO8ckeIRWjFSqMT92wgNcPCUgXfkyyICunMnKH"

#define ssid "Cristo_Liberta"
#define password "579!!Oo296"


FirebaseData data_park;

//para el timestamp

//const char* ntpServer = "pool.ntp.org";

//const long  gmtOffset_sec = 21600;
//const int   daylightOffset_sec = 3600;



//Espacio5
const int trigPin5 = 13;  //D7
const int echoPin5 = 14; //D5
const int led_5verde= 4;  //D2
const int led_5rojo = 5;  //D1



//Peticion /Parking_Status/id_parqueo/id_slot/estado
//Ejemplo:/Parking_Status/-Mq73KmXyn-fx7tlnIQn/-N-t_vx07IoxzsBpIURf/estado


//Id del parqueo

const String id_parqueo="-Mq73KmXyn-fx7tlnIQn";


// Id de los slots


String id5= "-N7ThM_XDVi2HIaG9Nps";



String doc5= "/Parking_Status/"+id_parqueo+"/"+id5+"/estado";









//define sound velocity in cm/uS
#define SOUND_VELOCITY 0.034
#define CM_TO_INCH 0.393701
;


long duration5;
float distanceCm5;
float distanceInch5;

int timestamp;






void setup() {

  // Init and get the time


  
  Serial.begin(115200); // Starts the serial communication


      
      pinMode(led_5verde, OUTPUT); // Sets the echoPin as an Input
  pinMode(led_5rojo, OUTPUT); 
  

  

     pinMode(trigPin5, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin5, INPUT);


   WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    Serial.print(".");
  }

  Firebase.begin(project,secret);
  
}

void loop() {

  


  
  
  digitalWrite(trigPin5, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin5, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin5, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration5 = pulseIn(echoPin5, HIGH);
  
  // Calculate the distance
  distanceCm5 = duration5 * SOUND_VELOCITY/2;
  
  // Convert to inches
  distanceInch5 = distanceCm5 * CM_TO_INCH;
  
  // Prints the distance on the Serial Monitor
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm5);
  Serial.print("Distance (inch): ");
  Serial.println(distanceInch5);

      //Firebase.setFloat("distance", distancecm);

          //Firebase.setFloat(data_park,doc2, distanceCm );  // send bool to firebase




    
    if (distanceCm5 < 10) {                      //if distance is less than 6cm then on led 
        Serial.println("5_Occupied ");
                  Firebase.setBool(data_park,doc5, false );  // send bool to firebase
                  digitalWrite(led_5rojo,HIGH);

                                                      digitalWrite(led_5verde,LOW);

  }

  if (distanceCm5 > 10) {                        //if distance is greater than 6cm then off led 
        Serial.println("5_Available ");

                  Firebase.setBool(data_park,doc5, true );  // send bool to firebase

                   digitalWrite(led_5rojo,LOW);

                                                      digitalWrite(led_5verde,HIGH);

  }
  

  
  
  delay(1000);



}
