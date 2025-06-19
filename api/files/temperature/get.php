<?php
$name = trim(file_get_contents("name.txt"));
$value = trim(file_get_contents("value.txt"));
$time = trim(file_get_contents("time.txt"));

$response = [
    'sensor' => $name,
    'value' => $value,
    'timestamp' => $time
];

header('Content-Type: application/json');
echo json_encode($response);
?>
