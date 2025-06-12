<?php
// models/ProductModel.php
class ProductModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAllProducts() {
        return $this->conn->query("SELECT * FROM products");
    }
    public function addProduct($name, $price, $stock) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $name, $price, $stock);
        return $stmt->execute();
    }
    public function updateProduct($id, $name, $price, $stock) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, price=?, stock=? WHERE id=?");
        $stmt->bind_param("sdii", $name, $price, $stock, $id);
        return $stmt->execute();
    }
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}