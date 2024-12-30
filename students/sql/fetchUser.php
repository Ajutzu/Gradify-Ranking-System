<?php

$stmt = $conn->prepare('SELECT * FROM users_table WHERE user_id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$row = $stmt->get_result();
$user = $row->fetch_assoc();

$stmt->close();