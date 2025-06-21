import cv2
import os
import requests
from datetime import datetime

# Webcam source
webcam_url = "https://rooftop.tryfail.net/image.jpeg"

# Folder to save images
img_folder = "img"
os.makedirs(img_folder, exist_ok=True)

# Timestamped filename
now = datetime.now().strftime("%Y%m%d_%H%M%S")
unique_filename = f"webcam_{now}.jpg"
latest_filename = "webcam.jpg"

# Capture image from URL
cap = cv2.VideoCapture(webcam_url)
ret, frame = cap.read()

if ret:
    # Save two versions: one with timestamp, one fixed name
    cv2.imwrite(os.path.join(img_folder, unique_filename), frame)
    cv2.imwrite(os.path.join(img_folder, latest_filename), frame)
    print("Image captured.")

    upload_url = "http://192.168.1.71/ti/api/upload.php"

    for fname in [unique_filename, latest_filename]:
        with open(os.path.join(img_folder, fname), 'rb') as f:
            files = {'image': (fname, f, 'image/jpeg')}
            response = requests.post(upload_url, files=files)

        if response.status_code == 200:
            print(f"{fname} uploaded successfully:", response.text)
        else:
            print(f"Upload failed for {fname}:", response.status_code, response.text)

else:
    print("Failed to capture image from webcam.")

cap.release()
