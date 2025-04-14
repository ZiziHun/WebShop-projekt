<?php
$host = 'localhost'; // MySQL host
$user = 'root'; // MySQL username
$pass = ''; //MySQL password
$dbname = 'bingusz'; // MySQL database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Kapcsolódási hiba: ' . $conn->connect_error);
}
?>
