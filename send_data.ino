#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif
#include <Wire.h>
#include <dht11.h>
#define DHT11PIN D6

const char* ssid     = "Silviu";
const char* password = "931806809";
const char* serverName = "http://licenta.silviuandrei.com/post-esp-data.php";
String apiKeyValue = "tPmAT5Ab3j7F9";
int sensorValue;
dht11 DHT11;
unsigned long previousMillis = 0;       
const long interval = 30000;    
       
void setup() 
{
  Serial.begin(115200);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) 
  { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  Wire.begin();
  Serial.begin(9600);
}

void loop() 
{
  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
  sensorValue = analogRead(A0);
  int chk = DHT11.read(DHT11PIN);
  if(WiFi.status()== WL_CONNECTED)
  {
    HTTPClient http;
    WiFiClient client;

    http.begin(client, serverName);
    
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    String httpRequestData = "api_key=" + apiKeyValue + "&value1=" + String(DHT11.temperature) + "&value2=" + String(DHT11.humidity) + "&value3=" + String(sensorValue) + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    int httpResponseCode = http.POST(httpRequestData);
     
    if (httpResponseCode>0) 
    {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
    }
    else 
    {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  }
  else 
  {
    Serial.println("WiFi Disconnected");
  }
  
  delay(15000);  
  }
}
