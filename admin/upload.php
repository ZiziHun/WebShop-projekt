<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tegyük fel, hogy a form mezői: nev, email
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $picture = isset($_POST['picture']) && !empty($_POST['picture']) ? $conn->real_escape_string($_POST['picture']) : 'dummy';
    $discount = $conn->real_escape_string($_POST['discount']);

    $sql = "INSERT INTO items (name, description, price, picture, discount) VALUES ('$name', '$description', '$price', '$picture', '$discount')";

    if ($conn->query($sql) === TRUE) {
        echo "Sikeres mentés!";
    } else {
        echo "Hiba: " . $conn->error;
    }

    $conn->close();
}
?>
