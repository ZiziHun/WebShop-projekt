<?php
session_start();

// Ellenőrizzük, hogy van-e termék ID, amit törölni szeretnénk
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Ha a kosárban van a termék, akkor eltávolítjuk
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Törlés
    }

    // Visszairányítjuk a felhasználót a kosár oldalra
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
