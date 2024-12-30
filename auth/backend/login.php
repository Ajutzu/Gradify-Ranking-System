<?php
include '../../config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password']; 

    $stmt = $conn->prepare('SELECT * FROM users_table WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) { 
        $user_password = $row['password'];

        if (password_verify($password, $user_password)) {
            $_SESSION['user_id'] = $row['user_id'];

            header('Location: ../../students/userDashboard.php');
        } else {
            header('Location: ../../index.php?answer=Authentication Failed');
        }
    } else {
        header('Location: ../../index.php?answer=Authentication Failed');
    }

    $stmt->close();
    exit();
}
?>
