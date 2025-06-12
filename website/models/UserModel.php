<?php
// models/UserModel.php
class UserModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function updateProfile($userId, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET email=?, password=? WHERE id=?");
        $stmt->bind_param("ssi", $email, $hashedPassword, $userId);
        return $stmt->execute();
    }
    public function getUserGrowth() {
        return $this->conn->query("SELECT DATE(created_at) AS date, COUNT(*) AS users FROM users GROUP BY DATE(created_at) ORDER BY date ASC");
    }
}
