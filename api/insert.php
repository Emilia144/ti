<?php
$sensor = $_POST['name'] ?? 'unknown';
$value = $_POST['value'] ?? '';
$timestamp = date('Y-m-d H:i:s');

// Ensure folder for the sensor exists
$folder = "files/$sensor";
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Save current data
file_put_contents("$folder/value.txt", $value);
file_put_contents("$folder/time.txt", $timestamp);
file_put_contents("$folder/name.txt", $sensor, LOCK_EX);
file_put_contents("$folder/log.txt", "$timestamp;$value\n", FILE_APPEND);  // <-- CLEAN log format

echo "OK";
?>
