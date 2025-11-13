<?php
require_once "../../webpage/site_config_vars.php";
require_once "../includes/db_config.php";
require_once "../classes/RobotDatabase.php";
session_start();
$username = $_POST["user"]; 

$qry = "SELECT * FROM User WHERE Name = :u";
$params = [":u"=> $username];
$users = TriviaDatabase::getDataFromSQL($qry,$params);

    // If username is found
    if (is_array($users) && count($users) > 0) { 
        echo "Username exists, please choose another!";
        header("Location: ../../webpage/login.php&error=User already exists");
    } else {
        $rawpassword = $_POST['password'];
        $hashed_password = MD5($salt1 . $rawpassword . $salt2);

        // Password requirement variables
        $minlength = 8;
        $maxlength = 20;

        // Check for complex password (minimum length, maximum length, capital letter, lowercase letter, number, special character)
        if (strlen($rawpassword) >= $minlength && strlen($rawpassword) <= $maxlength && preg_match('/[A-Z]/', $rawpassword) && preg_match('/[a-z]/', $rawpassword) && preg_match('/[0-9]/', $rawpassword) && preg_match('/[^A-Za-z0-9]/', $rawpassword)){
            $sql="INSERT INTO User (username, pass) VALUES (:u, :p);"; // Hash the password
            $params=[":u"=> $username, ":p"=>$hashed_password]; // No SQLi allowed
            TriviaDatabase::executeSQL($sql,$params); // Add user info into database
            header("Location: ../../webpage/login.php"); // Redirect to login page
        } else {
            $password_error_message = "Password needs to contain between 8 and 20 characters, a capital letter, a lowercase letter, a number, and a special character."; // Error message
            echo "<script>
                alert(" . json_encode($password_error_message) . ");
                window.history.back();
            </script>"; // Alert including error message
        }

    }
exit();
?>