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
            $_SESSION['username'] = $row['username'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['profile_picture'] = $row['profile_picture'];
            $_SESSION['profile_cover'] = $row['profile_cover'];
            $_SESSION['date_created'] = $row['date_created'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['gender'] = $row['gender'];

            header('Location: ../../students/userDashboard.php?answer=Success');
        } else {
            header('Location: ../../index.php?answer=Invalid Password');
        }
    } else {
        header('Location: ../../index.php?answer=Authentication Failed');
    }

    $stmt->close();
    exit();
}
?>
