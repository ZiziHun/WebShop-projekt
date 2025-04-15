<?php
<<<<<<< HEAD
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'bingusz';
=======
$host = 'localhost'; // MySQL host
$user = 'root'; // MySQL username
$pass = ''; //MySQL password
$dbname = 'bingusz'; // MySQL database name
>>>>>>> 6c44f036522e5a0d80cf38f1594efd53bd726677

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Kapcsolódási hiba: ' . $conn->connect_error);
}
?>
