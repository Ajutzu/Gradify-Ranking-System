<?php

$stmt = $conn->prepare("SELECT 
    cs.classroom_id,
    cs.user_id as top3_id,
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
WHERE 
    cs.classroom_id = ?
ORDER BY 
    cs.classroom_id, rank
LIMIT 3");

$stmt->bind_param("i", $id);
$stmt->execute();
$top3 = $stmt->get_result();
