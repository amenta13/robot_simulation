<?php
    require_once './db_config.php';

    $conn = new mysqli($host, $db_user, $db_pass, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>