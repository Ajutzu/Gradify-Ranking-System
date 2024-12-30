<?php

include '../../config/db.php';

$classroom_id = $_POST['classroom_id'];

$stmt = $conn->prepare("SELECT * FROM subjects_table WHERE classroom_id = ?");
$stmt->bind_param('i', $classroom_id);
$stmt->execute();
$result = $stmt->get_result();

$total_units = 0;
$i = 0;
$subject_grades = [];
$units = [];

while ($row = $result->fetch_assoc()) {
    $subject_grades[$i] = $_POST[str_replace(' ', '_', $row['subject_code'])];
    $units[$i] = $row['units'];
    $total_units += $row['units'];
    $i++;
}

$stmt->close();

$value = [];

for($i = 0; $i < count($subject_grades); $i++) {
    $value[$i] = $subject_grades[$i] * $units[$i];
}

$total_values = 0;
for($i = 0; $i < count($value); $i++) {
    $total_values += $value[$i];
}

$GPA = $total_values / $total_units;

$decimal_GPA = number_format($GPA, 4);

$stmt = $conn->prepare("UPDATE classroom_student SET student_gpa = ? WHERE user_id = ? and classroom_id = ?");
$stmt->bind_param("sii", $decimal_GPA, $_SESSION['user_id'], $classroom_id);
$stmt->execute();

if ($stmt->execute()) {
    header("Location: ../classroom.php?id=" . $classroom_id . "&output=success");
} else {
    header("Location: ../classroom.php?id=" . $classroom_id . "&output=error");
}

exit();


