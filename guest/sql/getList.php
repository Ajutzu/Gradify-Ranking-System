<?php

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT 
                               cs.classroom_id,
                               ct.classroom_name,
                               cs.user_id,
                               u.fullname,
                               u.email,
                               u.profile_picture,
                               cs.student_gpa,
                               DENSE_RANK() OVER (PARTITION BY cs.classroom_id ORDER BY cs.student_gpa DESC) AS rank
                           FROM 
                               classroom_student cs
                           JOIN 
                               users_table u
                           ON 
                               cs.user_id = u.user_id
                           JOIN
                               classroom_table ct
                           ON 
                              cs.classroom_id = ct.classroom_id
                           WHERE 
                               cs.classroom_id = ?
                           ORDER BY 
                               cs.classroom_id, rank;");

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$result->data_seek(0);
$classroom = $result->fetch_assoc();