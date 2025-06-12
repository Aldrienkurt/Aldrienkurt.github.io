<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "../config/db.php";
    include "../models/UserModel.php";
    $userModel = new UserModel($conn);
    
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($userModel->registerUser($email, $password)) {
            echo "Registration successful!";
        } else {
            echo "Error in registration!";
        }
    }
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userId = $userModel->loginUser($email, $password);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header("Location: ../views/home.php");
            exit();
        } else {
            echo "Invalid login credentials!";
        }
    }
}