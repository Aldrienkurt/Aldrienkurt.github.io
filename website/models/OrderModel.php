// models/OrderModel.php
<?php 
class OrderModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getUserOrders($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function getAllOrders() {
        return $this->conn->query("SELECT * FROM orders");
    }
    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }
    public function getTotalSales() {
        $result = $this->conn->query("SELECT SUM(total_price) AS total_sales FROM orders WHERE status = 'Completed'");
        return $result->fetch_assoc()["total_sales"] ?? 0;
    }
    public function getTotalOrders() {
        $result = $this->conn->query("SELECT COUNT(*) AS total_orders FROM orders");
        return $result->fetch_assoc()["total_orders"] ?? 0;
    }
    public function getTopProducts() {
        return $this->conn->query("SELECT p.name, SUM(o.quantity) AS total_sold FROM order_items o JOIN products p ON o.product_id = p.id GROUP BY p.id ORDER BY total_sold DESC LIMIT 5");
    }
    public function getSalesOverTime() {
        return $this->conn->query("SELECT DATE(created_at) AS date, SUM(total_price) AS sales FROM orders WHERE status = 'Completed' GROUP BY DATE(created_at) ORDER BY date ASC");
    }
    public function getRecentOrders() {
        return $this->conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
    }
}