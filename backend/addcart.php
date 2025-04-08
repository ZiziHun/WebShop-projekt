<?php
session_start(); // A session indítása

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    // A termék ID-jét a gombhoz rendeljük
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Ha a kosár még nem létezik, létrehozzuk
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Kosár tömb
    }

    // Ellenőrizzük, hogy a termék már benne van-e a kosárban
    if (isset($_SESSION['cart'][$product_id])) {
        // Ha van, frissítjük a mennyiséget
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Ha nincs, hozzáadjuk az új terméket
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        );
    }
}

// Visszairányítás a termékoldalra
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
