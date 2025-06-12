<?php 
// controllers/OrderController.php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    include "../config/db.php";
    include "../models/OrderModel.php";
    $orderModel = new OrderModel($conn);
    
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];
    $orderModel->updateOrderStatus($orderId, $status);
    
    header("Location: ../views/admin_orders.php");
    exit();
}

if ($_SESSION['role'] === 'admin') {
    $orders = $orderModel->getAllOrders();
    $totalSales = $orderModel->getTotalSales();
    $totalOrders = $orderModel->getTotalOrders();
    $topProducts = $orderModel->getTopProducts();
    $salesOverTime = $orderModel->getSalesOverTime();
    $recentOrders = $orderModel->getRecentOrders();
    
    include "../models/UserModel.php";
    $userModel = new UserModel($conn);
    $userGrowth = $userModel->getUserGrowth();
} else {
    $orders = $orderModel->getUserOrders($_SESSION['user_id']);
}