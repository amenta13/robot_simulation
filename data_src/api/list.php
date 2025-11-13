<?php
require_once __DIR__ . "/../../webpage/site_config_vars.php";
require_once __DIR__ . "/../includes/db_config.php";
require_once __DIR__ . "/../classes/RobotDatabase.php";

$sql = "SELECT Name FROM User ORDER BY UserID DESC;";

$results = RobotDatabase::getDataFromSQL($sql);
$users = array();

if(is_array($results) && count($results)>0) { 
    foreach($results as $row) {
        $users[] = $row["Name"];
    }
}

echo json_encode($users);

?>