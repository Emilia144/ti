<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['command'])) {
    $command = $_POST['command'];

    // save command in the actuator file
    file_put_contents("api/files/warningsystem/value.txt", $command);

    echo "Command '" . htmlspecialchars($command) . "' executed.<br>";

    // if on, show the values again
    if ($command === "ON") {
        $tempValue = floatval(file_get_contents("api/files/temperature/value.txt"));

        if ($tempValue < 20) {
            file_put_contents("api/files/warningsystem/value.txt", "COLD");
        } elseif ($tempValue < 25) {
            file_put_contents("api/files/warningsystem/value.txt", "MODERATE");
        } else {
            file_put_contents("api/files/warningsystem/value.txt", "HOT");
        }

        echo "Updated warningsystem based on current temperature.";
    }

} else {
    echo "Invalid request.";
}
?>
