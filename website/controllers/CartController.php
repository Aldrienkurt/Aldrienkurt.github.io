<?php 

session_start();

if (isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $productid = $_POST['productid'];
    $_SESSION['cart'][$productid] = ($_SESION['cart'] [$productid]  ?? 0) + 1;
}

header('Location: /cart.php');
?>