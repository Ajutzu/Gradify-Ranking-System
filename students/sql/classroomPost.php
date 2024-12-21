<?php

$stmt = $conn->prepare("SELECT 
    cp.post_id,
    cp.description,
    cp.rank,
    cp.gpa,
    cp.post_created,
    u.user_id,
    u.username,
    u.profile_picture,
    u.fullname,
    u.email,
    c.classroom_id,
    c.classroom_name,
    c.classroom_code
FROM 
    classroom_post cp
INNER JOIN 
    users_table u ON cp.user_id = u.user_id
INNER JOIN 
    classroom_table c ON cp.classroom_id = c.classroom_id
WHERE 
    cp.classroom_id = ?
ORDER BY cp.rank DESC
LIMIT 10;
");

$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result();
