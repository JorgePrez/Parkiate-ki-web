
#include "FirebaseESP32.h"

//#include <ESP8266WiFi.h>   //node mcu
//#include <WiFi.h>

//#include "time.h"



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



//Espacio1
const int trigPin1 = 14;
const int echoPin1 = 13;
const int led_1verde= 27;
const int led_1rojo = 26;


//Espacio2

const int trigPin2 = 32;
const int echoPin2 = 35;
const int led_2verde= 33;
const int led_2rojo = 25;


const int trigPin4= 5;
const int echoPin4 = 18;
const int led_4verde= 17;
const int led_4rojo = 16;


const int trigPin3 = 22;
const int echoPin3 = 23;
const int led_3verde= 19;
const int led_3rojo = 21;


/*
const int trigPin5= 26;
const int echoPin5 = 27;
const int led_5verde= 17;
const int led_5rojo = 16;
*/
/*

{
      
        "-N-z1WyD84Z1_hHh4nkQ": {
          
        },
        "-N02aeTREkypDcfEQ8Ch": {
     
        },
        "-N02alg3lI1WRKBLKyWt": {
         
        },
        "-N02bNZNPsszn9wekk32": {
       
        },
        "-N02bSTo1QKk2_q4nAl5": {
     
        }
    }
}


*/




//Peticion /Parking_Status/id_parqueo/id_slot/estado
//Ejemplo:/Parking_Status/-Mq73KmXyn-fx7tlnIQn/-N-t_vx07IoxzsBpIURf/estado


//Id del parqueo

const String id_parqueo="-Mq73KmXyn-fx7tlnIQn";


// Id de los slots

String id1= "-N7ThY5BhhVqwxi6vJQM";  //p9

String id2="-N7ThVS63iSiqu6unsJa";  //p8
            
String id3 = "-N7ThTRoPVI94K9orO9n";  //p7

String id4= "-N7ThR-dJOMYKmBmSZjY";  //p6

String id5= "-N3jbyztY7Oj5jN2n2VH";

// Rutas para cambiar el valor   : /Parking_Status/parqueo1/p1

String doc1= "/Parking_Status/"+id_parqueo+"/"+id1+"/estado";

String doc2= "/Parking_Status/"+id_parqueo+"/"+id2+"/estado";

String doc3= "/Parking_Status/"+id_parqueo+"/"+id3+"/estado";

String doc4= "/Parking_Status/"+id_parqueo+"/"+id4+"/estado";

//String doc5= "/Parking_Status/"+id_parqueo+"/"+id5+"/estado";









//define sound velocity in cm/uS
#define SOUND_VELOCITY 0.034
#define CM_TO_INCH 0.393701

long duration1;
float distanceCm1;
float distanceInch1;


long duration2;
float distanceCm2;
float distanceInch2;

long duration3;
float distanceCm3;
float distanceInch3;

long duration4;
float distanceCm4;
float distanceInch4;


long duration5;
float distanceCm5;
float distanceInch5;

int timestamp;


/*4444444444444444444444444
bool 1pasodelibreacupado=false;
bool 2pasodelibreacupado=false;
bool 3pasodelibreacupado=false;
bool 4pasodelibreacupado=false;
*/


/*
unsigned long getTime() {
  time_t now;
  struct tm timeinfo;
  if (!getLocalTime(&timeinfo)) {
    //Serial.println("Failed to obtain time");
    return(0);
  }
  time(&now);
  return now;
}*/

void setup() {

  // Init and get the time


  
  Serial.begin(115200); // Starts the serial communication

  //  configTime(0, 0, ntpServer);


  pinMode(trigPin1, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin1, INPUT); // Sets the echoPin as an Input

    pinMode(led_1verde, OUTPUT); // Sets the echoPin as an Input
  pinMode(led_1rojo, OUTPUT); // Sets the echoPin as an Input


    pinMode(trigPin2, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin2, INPUT); // Sets the echoPin as an Input
  
    pinMode(led_2verde, OUTPUT); // Sets the echoPin as an Input
  pinMode(led_2rojo, OUTPUT); // Sets the echoPin as an Input

      pinMode(led_3verde, OUTPUT); // Sets the echoPin as an Input
  pinMode(led_3rojo, OUTPUT); 

    pinMode(led_4verde, OUTPUT); // Sets the echoPin as an Input
  pinMode(led_4rojo, OUTPUT); 
      
  //    pinMode(led_5verde, OUTPUT); // Sets the echoPin as an Input
  //pinMode(led_5rojo, OUTPUT); 
  

  
    pinMode(trigPin3, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin3, INPUT);

      pinMode(trigPin4, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin4, INPUT);

   //   pinMode(trigPin5, OUTPUT); // Sets the trigPin as an Output
  //pinMode(echoPin5, INPUT);


   WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    Serial.print(".");
  }

  Firebase.begin(project,secret);
  
}

void loop() {

  
//   timestamp = getTime();
  //  Serial.print ("time: ");
  //  Serial.println (timestamp);

  
  // Clears the trigPin
  digitalWrite(trigPin1, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin1, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin1, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration1 = pulseIn(echoPin1, HIGH);
  
  // Calculate the distance
  distanceCm1 = duration1 * SOUND_VELOCITY/2;
  
  // Convert to inches
  distanceInch1 = distanceCm1 * CM_TO_INCH;
  
  // Prints the distance on the Serial Monitor
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm1);
  Serial.print("Distance (inch): ");
  Serial.println(distanceInch1);

      //Firebase.setFloat("distance", distancecm);

          //Firebase.setFloat(data_park,"/Parking_Status/espacio1", distanceCm );  // send string to firebase




    
    if (distanceCm1 < 10) {                      //if distance is less than 6cm then on led 
        Serial.println("1:Occupied ");
                  Firebase.setBool(data_park,doc1, false );  // send bool to firebase
                                    digitalWrite(led_1verde,LOW);

                                                      digitalWrite(led_1rojo,HIGH);



  }

    if (distanceCm1 > 10){                     //if distance is greater than 6cm then off led 
        Serial.println("1:Available ");

                  Firebase.setBool(data_park,doc1, true );  // send bool to firebase

                    digitalWrite(led_1verde,HIGH);

                                                      digitalWrite(led_1rojo,LOW);

  }




    digitalWrite(trigPin2, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin2, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration2 = pulseIn(echoPin2, HIGH);
  
  // Calculate the distance
  distanceCm2 = duration2 * SOUND_VELOCITY/2;
  
  // Convert to inches
  distanceInch2 = distanceCm2 * CM_TO_INCH;
  
  // Prints the distance on the Serial Monitor
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm2);
  Serial.print("Distance (inch): ");
  Serial.println(distanceInch2);

      //Firebase.setFloat("distance", distancecm);

          //Firebase.setFloat(data_park,doc2, distanceCm );  // send bool to firebase




    
    if (distanceCm2 < 10) {                      //if distance is less than 6cm then on led 
        Serial.println("2_Occupied ");
                  Firebase.setBool(data_park,doc2, false );  // send bool to firebase
                      

                                                      
                       digitalWrite(led_2verde,LOW);

                                                      digitalWrite(led_2rojo,HIGH);


  }

   if (distanceCm2 > 10) {                        //if distance is greater than 6cm then off led 
        Serial.println("2_Available ");

                  Firebase.setBool(data_park,doc2, true );  // send bool to firebase
              


                                                         digitalWrite(led_2verde,HIGH);

                                                      digitalWrite(led_2rojo,LOW);

  }
  

  
 // delay(1000);

  

    digitalWrite(trigPin3, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin3, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin3, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration3 = pulseIn(echoPin3, HIGH);
  
  // Calculate the distance
  distanceCm3 = duration3 * SOUND_VELOCITY/2;
  
  // Convert to inches
  distanceInch3 = distanceCm3 * CM_TO_INCH;
  
  // Prints the distance on the Serial Monitor
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm3);
  Serial.print("Distance (inch): ");
  Serial.println(distanceInch3);

      //Firebase.setFloat("distance", distancecm);

          //Firebase.setFloat(data_park,doc2, distanceCm );  // send bool to firebase




    
    if (distanceCm3 < 10) {                      //if distance is less than 6cm then on led 
        Serial.println("3_Occupied ");
                  Firebase.setBool(data_park,doc3, false );  // send bool to firebase
                                                       
                   
    digitalWrite(led_3verde,LOW);

                                                      digitalWrite(led_3rojo,HIGH);
                                                

  }

   if (distanceCm3 > 10) {                        //if distance is greater than 6cm then off led 
        Serial.println("3_Available ");

                  Firebase.setBool(data_park,doc3, true );  // send bool to firebase
                              

                                                        digitalWrite(led_3verde,HIGH);

                                                      digitalWrite(led_3rojo,LOW);

  }


  digitalWrite(trigPin4, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin4, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin4, LOW);
  
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration4 = pulseIn(echoPin4, HIGH);
  
  // Calculate the distance
  distanceCm4 = duration4 * SOUND_VELOCITY/2;
  
  // Convert to inches
  distanceInch4 = distanceCm4 * CM_TO_INCH;
  
  // Prints the distance on the Serial Monitor
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm4);
  Serial.print("Distance (inch): ");
  Serial.println(distanceInch4);

      //Firebase.setFloat("distance", distancecm);

          //Firebase.setFloat(data_park,doc2, distanceCm );  // send bool to firebase




    
    if (distanceCm4 < 10) {                      //if distance is less than 6cm then on led 
        Serial.println("4_Occupied ");
                  Firebase.setBool(data_park,doc4, false );  // send bool to firebase
                     digitalWrite(led_4rojo,HIGH);

                                                      digitalWrite(led_4verde,LOW);
               

  }

 if (distanceCm4 > 10) {                        //if distance is greater than 6cm then off led 
        Serial.println("4_Available ");

                  Firebase.setBool(data_park,doc4, true );  // send bool to firebase

                  
                 

                                                           digitalWrite(led_4verde,HIGH);

                                                      digitalWrite(led_4rojo,LOW);

  }
  
  
  /*digitalWrite(trigPin5, LOW);
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
                  digitalWrite(led_5verde,HIGH);

                                                      digitalWrite(led_5rojo,LOW);

  }

  if (distanceCm5 > 10) {                        //if distance is greater than 6cm then off led 
        Serial.println("5_Available ");

                  Firebase.setBool(data_park,doc5, true );  // send bool to firebase

                   digitalWrite(led_5verde,LOW);

                                                      digitalWrite(led_5rojo,HIGH);

  }
  

  
  */
  delay(1000);



}

void printLocalTime(){
  struct tm timeinfo;
  if(!getLocalTime(&timeinfo)){
    Serial.println("Failed to obtain time");
    return;
  }
  Serial.println(&timeinfo, "%A, %B %d %Y %H:%M:%S");
  Serial.print("Day of week: ");
  Serial.println(&timeinfo, "%A");
  Serial.print("Month: ");
  Serial.println(&timeinfo, "%B");
  Serial.print("Day of Month: ");
  Serial.println(&timeinfo, "%d");
  Serial.print("Year: ");
  Serial.println(&timeinfo, "%Y");
  Serial.print("Hour: ");
  Serial.println(&timeinfo, "%H");
  Serial.print("Hour (12 hour format): ");
  Serial.println(&timeinfo, "%I");
  Serial.print("Minute: ");
  Serial.println(&timeinfo, "%M");
  Serial.print("Second: ");
  Serial.println(&timeinfo, "%S");

  Serial.println("Time variables");
  char timeHour[3];
  strftime(timeHour,3, "%H", &timeinfo);
  Serial.println(timeHour);
  char timeWeekDay[10];
  strftime(timeWeekDay,10, "%A", &timeinfo);
  Serial.println(timeWeekDay);
  Serial.println();
}


/*
//#include <LiquidCrystal.h>


#include "FirebaseESP8266.h"
#include <ESP8266WiFi.h>

#include <Servo.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>


#define FIREBASE_HOST "parkiate-ki-default-rtdb.firebaseio.com"                 // the project name address from firebase id
#define FIREBASE_AUTH "zofO8ckeIRWjFSqMT92wgNcPCUgXfkyyICunMnKH"            // the secret key generated from firebase

#define WIFI_SSID "hEzt@ es m1 rhed (es jaker))"                                             // input your home or public wifi name 
#define WIFI_PASSWORD "579!!Oo296"                                    //password for Wifi
String Available = "";                                                  //availability string
String fireAvailable = "";


LiquidCrystal_I2C lcd(0x27, 16, 2);         //i2c display address 27 and 16x2 lcd display
Servo myservo;                          //servo as gate
Servo myservos;                               //servo as gate
int Empty;                            //available space integer
int allSpace = 90;
int countYes = 0;
int carEnter = D0;                      // entry sensor 
int carExited = D4;                   //exi sensor
int TRIG = D7;                  //ultrasonic trig  pin
int ECHO = D8;                // ultrasonic echo pin
int led = D3;                 // spot occupancy signal
int pos;
int pos1;

long duration, distance;     

FirebaseData ldr_data;


void setup() {
  delay(1000);
  Serial.begin (115200);     // serial debugging
  Wire.begin(D2, D1);       // i2c start
  myservo.attach(D6);      // servo pin to D6
  myservos.attach(D5);       // servo pin to D5
  pinMode(TRIG, OUTPUT);      // trig pin as output 
  pinMode(ECHO, INPUT);         // echo pin as input
  pinMode(led, OUTPUT);         // spot indication
  pinMode(carExited, INPUT);    // ir as input
  pinMode(carEnter, INPUT);     // ir as input

  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);                                     //try to connect with wifi
  Serial.print("Connecting to ");
  Serial.print(WIFI_SSID);                          // display ssid
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");                          // if not connected print this
    delay(500);
  }
  Serial.println();
  Serial.print("Connected to ");
  Serial.println(WIFI_SSID);
  Serial.print("IP Address is : ");
  Serial.println(WiFi.localIP());                                            //print local IP address
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);        // begin firebase authentication

  lcd.begin(16,2);                           //begin lcd
  lcd.home();                            
  lcd.setCursor(0, 0);                      // 0th row and 0thh column
  lcd.print("Smart Parking");    
}

void loop() {

  digitalWrite(TRIG, LOW);         // make trig pin low
  delayMicroseconds(2);
  digitalWrite(TRIG, HIGH);        // make trig pin high
  delayMicroseconds(10);
  digitalWrite(TRIG, LOW);
  duration = pulseIn(ECHO, HIGH);
  distance = (duration / 2) / 29.1;      // take distance in cm

    Serial.print("Centi meter: ");
    Serial.println(distance);

  int carEntry = digitalRead(carEnter);      // read ir input
  if (carEntry == HIGH) {                     // if high then count and send data
    countYes++;                             //increment count
    Serial.print("Car Entered = " ); Serial.println(countYes );
    lcd.setCursor(0, 1);
    lcd.print("Car Entered");
    for (pos = 140; pos >= 45; pos -= 1) {        // change servo position
      myservos.write(pos);                       
      delay(5);
    }
    delay(2000);

    for (pos = 45; pos <= 140; pos += 1) {       // change servo position
      // in steps of 1 degree
      myservos.write(pos);
      delay(5);
    }

    Firebase.pushString(ldr_data,"/Parking Status/",fireAvailable );    // send string to firebase
    lcd.clear();
  }
  int carExit = digitalRead(carExited);              //read exit ir sensor
  if (carExit == HIGH) {                            //if high then count and send
    countYes--;                                    //decrement count
    Serial.print("Car Exited = " ); Serial.println(countYes);
    lcd.setCursor(0, 1);
    lcd.print("Car Exited");
    for (pos1 = 140; pos1 >= 45; pos1 -= 1) {         // change servo position
      myservo.write(pos1);
      delay(5);
    }
    delay(2000);

    for (pos1 = 45; pos1 <= 140; pos1 += 1) {            // change servo position
      // in steps of 1 degree
      myservo.write(pos1);
      delay(5);
    }
    Firebase.pushString(ldr_data,"/Parking Status/", fireAvailable );  // send string to firebase
    lcd.clear();
  }
  if (distance < 6) {                      //if distance is less than 6cm then on led 
        Serial.println("Occupied ");
    digitalWrite(led, HIGH);
  }

  if (distance > 6) {                        //if distance is greater than 6cm then off led 
        Serial.println("Available ");
    digitalWrite(led, LOW);
  }

  Empty = allSpace - countYes;         //calculate available data
 
  Available = String("Available= ") + String(Empty) + String("/") + String(allSpace);       // convert the int to string
  fireAvailable = String("Available=") + String(Empty) + String("/") + String(allSpace);

  lcd.setCursor(0, 0);
  lcd.print(Available);                 //print available data to lcd

}








*/










/*

FirebaseData ldr_data;

#define project "parkiate-ki-default-rtdb.firebaseio.com"
#define secret "zofO8ckeIRWjFSqMT92wgNcPCUgXfkyyICunMnKH"

#define ssid "hEzt@ es m1 rhed (es jaker))"
#define password "579!!Oo296"

void setup()
{
  Serial.begin(115200);

  WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    Serial.print(".");
  }

  Firebase.begin(project,secret);
}

void loop(){
  Serial.println("Firebase Connected");

  int value = analogRead(A0);
  Serial.println(value);
  Firebase.setString(ldr_data,"/LDR/LDR",value);

   // Firebase.pushString(ldr_data,"/LDR/LDR",value);

}



*/



/*
#define username "internet_of_things"
#define password "1234567890"

ESP8266WebServer server;

String ledwebpage="<html><head><title> My first Webpage </title></head><body style=\"background-color:green\"><center><h1> IoT Led control </h1></center><form><center><button style=\"font-size:60\" type=\"submit\" value=\"0\" name=\"state\"> Led On </button><button style=\"font-size:60\" type=\"submit\" value=\"1\" name=\"state\"> Led Off </button></center></form></body></html>";

void setup()
{
  Serial.begin(115200);
  pinMode(16,OUTPUT);
  WiFi.softAP(username,password);
  Serial.println(WiFi.softAPIP());
  server.begin();
  server.on("/led",Led);
}

void loop()
{
  server.handleClient();
}

void Led()
{
  server.send(200,"text/html",ledwebpage);

  if((server.arg("state")=="0"))
  {
    digitalWrite(16,LOW);
  }
  else
  {
    digitalWrite(16,HIGH);
  }
}
*/








/*

void setup() 
{
  pinMode(16,OUTPUT);            // Make pin 16 as an output pin
  Serial.begin(115200);          // Start the serial Communication
}

void loop() 
{
  digitalWrite(16,LOW);         //Make pin 16 low to turn on the Led
  Serial.println("Led on");     // Print "led on" on the serial Monitor
}*/
