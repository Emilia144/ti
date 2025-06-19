<?php
$sensor = "temperature";
$value = $_POST['value'] ?? '';
$timestamp = date('Y-m-d H:i:s');

file_put_contents("value.txt", $value);
file_put_contents("time.txt", $timestamp);
file_put_contents("name.txt", $sensor, LOCK_EX);
file_put_contents("log.txt", "$timestamp - $sensor: $value\n", FILE_APPEND);

echo "OK";
?>
