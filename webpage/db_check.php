<?php
// db_check.php — upload to `webpage/` and visit in browser.
// WARNING: remove this file after debugging to avoid exposing info.

ini_set('display_errors', 1);
error_reporting(E_ALL);

$cfgPath = __DIR__ . '/../data_src/includes/db_config.php';
echo "<p>Looking for config at: <code>" . htmlspecialchars($cfgPath) . "</code></p>";
if (!file_exists($cfgPath)) {
    echo "<p style='color:red;'>Config file NOT FOUND.</p>";
    exit;
}
include $cfgPath;
echo "<p>Included config. Checking DB connection...</p>";

try {
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<p style='color:green;'>PDO connection succeeded.</p>";
    $stmt = $pdo->query("SELECT 1");
    echo "<p>Simple query OK.</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'>PDO connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
}

?>
