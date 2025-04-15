<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'bingusz';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Kapcsolódási hiba: ' . $conn->connect_error);
}
?>
