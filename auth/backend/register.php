<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']); 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = htmlspecialchars($_POST['gender']);
    $user_type = 'Student';

    if ($confirm_password !== $password) { 
        header('Location: ../../students/register.php?error=password_mismatch');
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users_table (username, fullname, email, password, gender, user_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $username, $fullname, $email, $hashed_password, $gender, $user_type);

    if ($stmt->execute()) {
        header('Location: ../../students/userDashboard.php?output=welcome');
    } else {
        header('Location: ../register.php?output=error');
    }

    $stmt->close();
    exit();
}

