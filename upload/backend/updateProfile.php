<?php
include '../../config/db.php';

$username = $_POST['username'] ?? '';
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';
$password = $_POST['password'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: ../../students/setting.php?output=invalid_user");
    exit();
}

$target_dir_profile = "../../upload/profile/";
$target_dir_cover = "../../upload/cover/";

$profile_picture = null;
$cover_photo = null;

if (!empty($_FILES["profile_picture"]["name"])) {
    $profile_picture = "upload/profile/" . basename($_FILES["profile_picture"]["name"]);
    $profile_picture_path = $target_dir_profile . basename($_FILES["profile_picture"]["name"]);
    if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture_path)) {
        header("Location: ../../students/setting.php?output=profile_upload_error");
        exit();
    }
}

if (!empty($_FILES["cover_photo"]["name"])) {
    $cover_photo = "upload/cover/" . basename($_FILES["cover_photo"]["name"]);
    $cover_photo_path = $target_dir_cover . basename($_FILES["cover_photo"]["name"]);
    if (!move_uploaded_file($_FILES["cover_photo"]["tmp_name"], $cover_photo_path)) {
        header("Location: ../../students/setting.php?output=cover_upload_error");
        exit();
    }
}

$query = "UPDATE users_table SET ";
$params = [];
$types = "";

if (!empty($username)) {
    $query .= "username = ?, ";
    $params[] = $username;
    $types .= "s";
}

if (!empty($fullname)) {
    $query .= "fullname = ?, ";
    $params[] = $fullname;
    $types .= "s";
}

if (!empty($email)) {
    $query .= "email = ?, ";
    $params[] = $email;
    $types .= "s";
}

if (!empty($gender)) {
    $query .= "gender = ?, ";
    $params[] = $gender;
    $types .= "s";
}

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query .= "password = ?, ";
    $params[] = $hashed_password;
    $types .= "s";
}

if ($profile_picture) {
    $query .= "profile_picture = ?, ";
    $params[] = $profile_picture;
    $types .= "s";
}

if ($cover_photo) {
    $query .= "profile_cover = ?, ";
    $params[] = $cover_photo;
    $types .= "s";
}

$query = rtrim($query, ", ") . " WHERE user_id = ?";
$params[] = $user_id;
$types .= "i";

$stmt = $conn->prepare($query);

if (!$stmt) {
    header("Location: ../../students/setting.php?output=db_error");
    exit();
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    header("Location: ../../students/setting.php?output=update_success");
} else {
    header("Location: ../../students/setting.php?output=update_error");
}


