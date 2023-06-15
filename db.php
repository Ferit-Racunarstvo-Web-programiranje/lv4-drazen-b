<?php
$maxTries = 10;
$tries = 0;

while ($tries < $maxTries) {
    $con = @mysqli_connect("172.28.1.2", "admin", "admin123", "web");

    if ($con) {
        break;
    }

    echo "Failed to connect to MySQL. Retrying in 5 seconds...\n";
    $tries++;
    sleep(5);
}

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL after $maxTries attempts: " . mysqli_connect_error();
    die();
}
?>