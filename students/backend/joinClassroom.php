<?php

include '../../config/db.php';

$classroomCode = $_POST['class_code']; 
$userId = $_SESSION['user_id']; 

$stmt = $conn->prepare("SELECT * FROM classroom_table WHERE classroom_code = ?");
$stmt->bind_param("s", $classroomCode);
$stmt->execute();
$result = $stmt->get_result();


if ($row = $result->fetch_assoc()) {

    $insertStmt = $conn->prepare("INSERT INTO classroom_student (classroom_id, user_id) VALUES (?, ?)");
    $insertStmt->bind_param("ii", $row['classroom_id'], $userId);

    if ($insertStmt->execute()) {
        header("Location: ../userDashboard.php?output=success");
        exit();
    } else {
        header("Location: ../userDashboard.php?output=error");    
        exit();
    }

} else {
    header("Location: ../userDashboard.php?output=invalid");    
    exit();
}



