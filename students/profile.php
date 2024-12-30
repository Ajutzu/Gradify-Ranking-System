<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gradify</title>

    <?php include '../config/cdn.php'; ?>
    <?php include 'sql/fetchProfile.php'; ?>
    <?php include '../security/session_management.php'; ?>

    <!-- Website Icon -->
    <link rel="icon" href="../images/ico.svg">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/userDashboard.css">
    <link rel="stylesheet" href="../css/classroom.css">

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
                <img src="<?php echo '../' . $user["profile_picture"] ?>" alt="Profile"
                    class="rounded-circle profile-img mb-2" width="80" height="80">
                <h6 class="mb-1"><?php echo $user["fullname"] ?></h6>
                <small class="text-muted"><?php echo $user["user_type"] ?></small>
            </div>
        </div>

        <nav>
            <a href="userDashboard.php" class="nav-item">
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
                                                   cs.user_id = ?;
                                               ");
                    $stmt->bind_param('i', $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();

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
            <a href="#" class="nav-item active mt-2">
                <i class="bi bi-person"></i>
                Profile
            </a>
            <a href="setting.php" class="nav-item mt-2">
                <i class="bi bi-gear"></i>
                Settings
            </a>
            <a href="../auth/backend/logout.php" class="nav-item text-danger mt-2">
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

        <div class="container mt-4">

            <!-- Profile Section -->
            <div class="cover">
                <div class="cover-photo-container">
                    <img src="<?php echo '../' . $user['profile_cover']; ?>" alt="Cover Photo" class="cover-img">
                </div>
                <div class="profile-section">
                    <div class="profile-photo-container">
                        <img src="<?php echo '../' . $user['profile_picture']; ?>" alt="Profile Photo" class="profile-image">
                    </div>
                    <div class="username-container">
                        <h5 class="name"><?php echo $user['fullname']; ?></h5>
                        <small class="text-muted"><?php echo $user['user_type']; ?></small>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- Classroom Tab -->
                <div class="tab-pane fade show active" id="classroom">
                    <div class="row">
                        <!-- Left Sidebar -->
                        <div class="col-md-3">
                            <!-- Meet Section -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-calculator-fill me-2"></i>
                                            <span>Highest Recorded GPA</span>
                                        </div>
                                    </div>
                                    <?php

                                    $highGPA = $conn->prepare("SELECT MAX(student_gpa) as gpa FROM classroom_student WHERE user_id = ?");
                                    $highGPA->bind_param("i", $_GET['profile']);
                                    $highGPA->execute();
                                    $gpa_result = $highGPA->get_result();
                                    $gpa_row = $gpa_result->fetch_assoc();

                                    ?>
                                    <small class="text-muted">GPA: <?php echo $gpa_row['gpa']; ?></small>
                                </div>
                            </div>

                            <!-- Upcoming Section -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">GPA History</h6>
                                    <!-- Using PHP loop for ranking list -->
                                    <div class="ranking-list mt-3">
                                        <?php

                                        $history = $conn->prepare("SELECT * FROM classroom_student WHERE user_id = ?");
                                        $history->bind_param("i", $_GET['profile']);
                                        $history->execute();
                                        $history_result = $history->get_result();

                                        while ($history_row = $history_result->fetch_assoc()) {
                                            echo '<div class="d-flex align-items-center gap-2 mb-2">
                                                <img src="../' . $user["profile_picture"] . '" 
                                                    alt="Profile" class="rounded-circle" width="32" height="32">
                                                <div>
                                                    <small class="fw-bold d-block">' . $user['fullname'] . '</small>
                                                    <small class="text-muted">GPA: ' . $history_row['student_gpa'] . '</small>
                                                </div>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Stream -->
                        <div class="col-md-9">
                            <div class="card">
                                <?php
                                
                                $history_post = $conn->prepare("SELECT * FROM classroom_post WHERE user_id = ?");
                                $history_post->bind_param("i", $_GET['profile']);
                                $history_post->execute();
                                $history_post_result = $history_post->get_result();

                                if ($post_row = $history_post_result->fetch_assoc()) { ?>
                                    <!-- Achievement Card -->
                                    <div class="achievement-card p-4">
                                        <div class="row align-items-center">
                                            <!-- Left Column: Profile Image -->
                                            <div class="col-md-4 text-center">
                                                <img src="<?php echo "../" . $user['profile_picture']; ?>"
                                                    alt="Profile"
                                                    class="rounded-circle profile-img mb-3 mb-md-0"
                                                    width="150"
                                                    height="150">
                                            </div>

                                            <!-- Right Column: Stats and Message -->
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h4 class="mb-3 ms-2"><?php echo $user['fullname']; ?></h4>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <button class="btn share-btn"
                                                            onclick="shareToFB()"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Share your achievement">
                                                            <i class="bi bi-share"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-4 mb-3">
                                                    <div class="achievement-stat">
                                                        <h3 class="mb-0"><?php echo $post_row['gpa'];?></h3>
                                                        <small class="text-muted">GPA</small>
                                                    </div>
                                                    <div class="achievement-stat">
                                                        <h3 class="mb-0"><i class="bi bi-trophy-fill"></i><?php echo $post_row['rank'];?></h3>
                                                        <small class="text-muted">Rank</small>
                                                    </div>
                                                </div>

                                                <!-- Congratulatory Message -->
                                                <div class="celebration-message">
                                                    <div class="confetti-bg p-3 rounded-4">
                                                        <h5 class="text-white mb-2">Congratulations!</h5>
                                                        <p class="mb-0 text-white"><?php echo $post_row['description'];?></p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="card-body py-5">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 text-center">
                                                <img src="../images/classroom.svg" alt="Stream" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                            <div class="col-md-8 text-md-start text-center">
                                                <h5>This is where you'll see Updates</h5>
                                                <p class="text-muted">Currently, you have no updates</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

</body>

</html>