<?php
function getConnection() {
$servername = "localhost";
$username = "root";
$password = "";
$database = "bmovie";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn -> connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
}
?>
