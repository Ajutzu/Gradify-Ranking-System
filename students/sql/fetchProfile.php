<?php

$stmt = $conn->prepare('SELECT * FROM users_table WHERE user_id = ?');
$stmt->bind_param('i', $_GET['profile']);
$stmt->execute();
$row = $stmt->get_result();
$user = $row->fetch_assoc();

$stmt->close();