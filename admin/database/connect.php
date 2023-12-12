<?php

function connectDB() {
    $host = "localhost";
    $dbname = "btth01_cse485";
    $username = "root";
    $password = "";

    try {
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
        return null;
    }
}

?>

