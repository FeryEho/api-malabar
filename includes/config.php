<?php

    //database configuration
    $host       = "192.168.27.88";
    $user       = "Mars";
    $pass       = "27272727";
    $database   = "rent-tech"; 

    $connect = new mysqli($host, $user, $pass, $database);

    if (!$connect) {
        die ("connection failed: " . mysqli_connect_error());
    } else {
        $connect->set_charset('utf8');
    }

?>