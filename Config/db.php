<?php

$host = '162.214.68.46';
$username = 'wwserv_bennetts';
$password = 'peoplecen24+';
$db = 'wwserv_tickets';

$conn = new mysqli($host, $username, $password, $db);

    if ($conn->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
//    echo $conexion->host_info . "\n";
