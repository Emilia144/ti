import time
from datetime import datetime
import RPi.GPIO as GPIO
import requests

#does the api post
def post2API(name, value):
    try:
        current_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        payload = {'name': name, 'value': value, 'time': current_time}
        print(payload)        
        r = requests.post('http://iot.dei.estg.ipleiria.pt/ti/ti040/ti-1/api/api.php', data=payload)
        print(r.text)
        ('post to API sent')
    except Exception as e:
        print("Error posting to API:", e)


#checks if the streetlights got turned on or off on the dashboard
def getFromAPI(name):
    try:
        response = requests.get(f'http://iot.dei.estg.ipleiria.pt/ti/ti040/ti-1/api/api.php?name={name}')
        if response.status_code == 200:
            data = response.json()
            print("Data from API:", data)
            return data.get('value')
        else:
            print("Error fetching data from API:", response.status_code)
    except Exception as e:
        print("Error in getFromAPI:", e)
        return None




GPIO.setmode(GPIO.BCM)
LED = 2
PHOTORESISTOR = 24

GPIO.setup(LED, GPIO.OUT)
GPIO.setup(PHOTORESISTOR, GPIO.IN)


try:
    while True:
        auto_mode = getFromAPI('auto_mode') # Check if automatic or manual streetlight mode is enabled
        current_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

        if auto_mode == '1':
            print("automatic streetlight control enabled")
            light_level = GPIO.input(PHOTORESISTOR)

            if light_level == GPIO.HIGH:
                print("It is dark, turning on the LED")
                post2API('light', 'dark')
                post2API('streetlights', 1)
                GPIO.output(LED, GPIO.HIGH)
            else:
                print("It is light, turning off the LED")
                post2API('light', 'light')
                post2API('streetlights', 0)
                GPIO.output(LED, GPIO.LOW)
        else:
            print("manual streetlight control enabled")
            manual_light = getFromAPI('manual_light')
            lights_status = getFromAPI('streetlights')
            if lights_status == '1':
                GPIO.output(LED, GPIO.HIGH)
            else:
                GPIO.output(LED, GPIO.LOW)
            
        time.sleep(5)  
except KeyboardInterrupt:
    print("\nprogram interrupted by user")
    GPIO.cleanup()
except Exception as e:
    print("Unexpected error:", e)
    print("Try again")

finally: GPIO.cleanup()
print('The program has ended')


