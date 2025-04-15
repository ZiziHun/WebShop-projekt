<?php
session_start(); 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $picture = $_POST['product_picture'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); 
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity,
            'picture' => $picture
        );
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
