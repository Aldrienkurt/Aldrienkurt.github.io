<?php

session_start();
include "../config/db.php";

if(isset($_SESSION['user_id'])){
    header ("Location: ../views/checkout.php");
    exit();
}

$totalPrice = 0;
foreach ($_SESSION['cart'] as $productid => $quantity){
    $sql = "SELECT * FROM products WHERE id = $productid";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    $totalPrice += $product['price'] * $quantity;
}

$conn->query("INSERT INTO orders (user_id, total_price) VALUES ({$_SESSION['user_id']}, $totalPrice)");

unset($_SESSION['cart']);
header("Location: ../views/order_success.php");
exit();
?>