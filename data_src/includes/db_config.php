<?php
global $host, $database, $db_user, $db_pass;
if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost"){
    $host = "localhost";
    $database = "robotworksdb";
    $db_user = "root";
    $db_pass = "";
}else{
    $host = "srv557.hstgr.io";
    $database = "u413142534_robotworksdb";
    $db_user = "u413142534_robotworks";
    $db_pass = "";
}

?>