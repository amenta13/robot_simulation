<?php
    global $installDir, $urlForNavBar,$protocol_used,$domain, $data_config_path,$fullInstallPath;

    $domain = $_SERVER["HTTP_HOST"];
    $protocol_used =isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'?"https://":"http://";
    $data_config_path = "../data_src/includes/db_config.php";

    if ($domain == "127.0.0.1" || $domain == "localhost") {

        $installDir = "robotwork";
        if (PHP_OS == "Darwin") {

            $fullInstallPath = "/Applications/XAMPP/xamppfiles/htdocs/robot_simulation";

        } else if (PHP_OS == "Linux") {

            $fullInstallPath = "/opt/lampp/htdocs/robot_simulation";

        } else {

            $fullInstallPath = "C:/xampp/htdocs/robot_simulation";

        }

    } else {

        $installDir = "";
        $fullInstallPath = "/home/u413142534/domains/etowndb.com/public_html/robotwork";  

    }

    if (!is_file($fullInstallPath."/".$data_config_path)) {

        echo "You didn't setup your database configuration file at {$data_config_path}.";
        exit();

    }
    if($installDir==""){
        $urlForNavBar = $protocol_used.$domain;
    }else{
        $urlForNavBar = $protocol_used.$domain."/".$installDir;
    }
?>