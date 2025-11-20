<?php
    global $installDir, $urlForNavBar,$protocol_used,$domain, $data_config_path,$fullInstallPath;

    $domain = $_SERVER["HTTP_HOST"];
    $protocol_used =isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'?"https://":"http://";
    $data_config_path = __DIR__ . "/../data_src/includes/db_config.php";

    if ($domain == "127.0.0.1" || $domain == "localhost") {

        $installDir = "robotworks";
        $fullInstallPath = __DIR__ . "/..";

    } else {

        $installDir = "";
        $fullInstallPath = "/home/u413142534/domains/etowndb.com/public_html/robotworks";  

    }

    if (!is_file($data_config_path)) {

        echo "You didn't setup your database configuration file at {$data_config_path}.\n";
        echo $fullInstallPath."/".$data_config_path;
        exit();

    }
    if($installDir==""){
        $urlForNavBar = $protocol_used.$domain;
    }else{
        $urlForNavBar = $protocol_used.$domain."/".$installDir;
    }
?>