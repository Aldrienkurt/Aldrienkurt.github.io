<?php
// controllers/UserController.php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_profile'])) {
    include "../config/db.php";
    include "../models/UserModel.php";
    $userModel = new UserModel($conn);
    
    $userId = $_SESSION['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userModel->updateProfile($userId, $email, $password);
    
    header("Location: ../views/profile.php");
    exit();
}
