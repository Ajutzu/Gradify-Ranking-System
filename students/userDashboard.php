<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gradify</title>

    <?php include '../config/cdn.php'; ?>

    <!-- Website Icon -->
    <link rel="icon" href="../images/ico.svg">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/userDashboard.css">

    <!-- JS -->
    <script src="../js/userDashboard.js" defer></script>
    <script src="../js/script.js" defer></script>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex flex-column align-items-center gap-2 mb-4">
            <button class="btn-close sidebar-close d-md-none position-absolute top-0 end-0 m-2 pt-2" aria-label="Close"></button>

            <div class="d-flex align-items-center gap-2">
                <img src="../images/ico.svg" alt="Gradify Logo" height="40">
                <h6 class="mb-0 pt-2">Gradify</h6>
            </div>
            <!-- User Profile Section -->
            <div class="text-center mt-4 mb-3">
                <img src="<?php echo '../' . $_SESSION["profile_picture"] ?>" alt="Profile"
                    class="rounded-circle profile-img mb-2" width="80" height="80">
                <h6 class="mb-1"><?php echo $_SESSION["fullname"] ?></h6>
                <small class="text-muted"><?php echo $_SESSION["user_type"] ?></small>
            </div>
        </div>

        <nav>
            <a href="#" class="nav-item active">
                <i class="bi bi-house"></i>
                Home
            </a>
            <a href="#" class="nav-item mt-2" data-bs-toggle="collapse" data-bs-target="#collapseClassrooms" aria-expanded="false" aria-controls="collapseClassrooms">
                <i class="bi bi-collection"></i>
                Top Classes
            </a>
            <div class="collapse show" id="collapseClassrooms">
                <div>
                    <?php
                    $stmt = $conn->prepare("SELECT 
                                                   ct.classroom_id,
                                                   ct.classroom_name,
                                                   ct.classroom_code,
                                                   ct.classroom_created,
                                                   ct.classroom_active,
                                                   cs.student_gpa,
                                                   u.username AS host_username,
                                                   u.fullname AS host_fullname,
                                                   u.email AS host_email,
                                                   u.profile_picture AS host_profile_picture,
                                                   joined_user.username AS joined_username,
                                                   joined_user.fullname AS joined_fullname,
                                                   joined_user.email AS joined_email,
                                                   joined_user.profile_picture AS joined_profile_picture
                                               FROM 
                                                   classroom_table ct
                                               INNER JOIN 
                                                   classroom_student cs ON ct.classroom_id = cs.classroom_id
                                               INNER JOIN 
                                                   users_table u ON ct.classroom_host = u.user_id
                                               INNER JOIN 
                                                   users_table joined_user ON cs.user_id = joined_user.user_id
                                               WHERE 
                                                   cs.user_id = ?
                                               GROUP BY 
                                                   ct.classroom_id;
                                               ");
                    $stmt->bind_param('i', $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $result->data_seek(0);

                    ?>
                    <div class="nested-nav">
                        <?php while ($classroom = $result->fetch_assoc()) { ?>
                            <a href="classroom.php?id=<?php echo $classroom['classroom_id']; ?>" class="mt-2 nav-item text-truncate" title="<?php echo $classroom['classroom_name']; ?>">
                                <img src="<?php echo "../" . $classroom['host_profile_picture']; ?>" alt="Class" class="rounded-circle" width="40" height="40">
                                <span class="text-truncate"><?php echo $classroom['classroom_name']; ?> - RANKING</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <a href="profile.php?profile=<?php echo $_SESSION['user_id']; ?>" class="nav-item mt-2">
                <i class="bi bi-person"></i>
                Profile
            </a>
            <a href="setting.php" class="nav-item mt-2">
                <i class="bi bi-gear"></i>
                Settings
            </a>
            <a href="../index.php" class="nav-item text-danger mt-2">
                <i class="bi bi-box-arrow-left text-danger"></i>
                Logout
            </a>
        </nav>
    </div>

    <?php include 'modal/joinClassroom.php'; ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-nav">
            <div class="text-end">
                <button class="btn d-md-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn" title="Join Class" data-bs-toggle="modal" data-bs-target="#joinClassroomModal">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>

        <div class="container-fluid mt-4">

            <?php if ($result->num_rows == 0) { ?>
                <div class="card-body py-5 text-center">
                    <div class="row align-items-center justify-content-center" style="height: 60vh;">
                        <div class="col-md-6">
                            <img src="../images/classroom.svg" alt="Stream" class="img-fluid mb-3" style="max-width: 200px;">
                            <h5 class="mb-3">Join Your First Classroom!</h5>
                            <p class="text-muted mb-4">Click the <i class="bi bi-plus-lg"></i> button above to join a classroom using a class code</p>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#joinClassroomModal">
                                <i class="bi bi-plus-circle me-2"></i>Join Classroom
                            </button>
                        </div>
                    </div>
                </div>
            <?php }; ?>

            <div class="classroom-grid">
                <?php

                $result->data_seek(0);

                while ($classroom = $result->fetch_assoc()) { ?>

                    <a href="classroom.php?id=<?php echo $classroom['classroom_id']; ?>" style="text-decoration: none" class="text-black">
                        <div class="classroom-card">
                            <div class="classroom-header">
                                <h3 class="classroom-title"><?php echo $classroom['classroom_name']; ?></h3>
                                <p class="classroom-subtitle">Current Rank: <?php echo $classroom['student_gpa']; ?></p>
                            </div>
                            <div class="classroom-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge <?php echo $classroom['classroom_active'] ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $classroom['classroom_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>

                                    <?php

                                    $studentCount = $conn->prepare("SELECT COUNT(user_id) as studentCount FROM classroom_student WHERE classroom_id = ?");
                                    $studentCount->bind_param('i', $classroom['classroom_id']);
                                    $studentCount->execute();
                                    $student_result = $studentCount->get_result();
                                    $studentCount = $student_result->fetch_assoc();
                                    
                                    ?>

                                    <small class="text-muted">Students: <?php echo $studentCount['studentCount']; ?></small>

                                </div>
                                <p class="text-muted">Current GPA: <?php if ($classroom['student_gpa'] == null) {
                                                                        echo '0';
                                                                    } else {
                                                                        echo $classroom['student_gpa'];
                                                                    }; ?></p>
                            </div>
                            <div class="classroom-details p-3 border-top">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="<?php echo '../' . $classroom['host_profile_picture']; ?>" alt="Creator"
                                        class="rounded-circle" width="30" height="30">
                                    <div>
                                        <small class="d-block">Created by</small>
                                        <strong><?php echo $classroom['host_fullname']; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>

<!-- URE-056 -->