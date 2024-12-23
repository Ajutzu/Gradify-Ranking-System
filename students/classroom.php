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
    <link rel="stylesheet" href="../css/classroom.css">
    <link rel="stylesheet" href="../css/userDashboard.css">

    <!-- JS -->
    <script src="../js/userDashboard.js" defer></script>
    <script src="../js/classroom.js" defer></script>
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
            <a href="userDashboard.php" class="nav-item">
                <i class="bi bi-house"></i>
                Home
            </a>
            <a href="#" class="nav-item mt-2 active" data-bs-toggle="collapse" data-bs-target="#collapseClassrooms" aria-expanded="false" aria-controls="collapseClassrooms">
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

    <?php
    $id = $_GET['id'];
    $stmt = $conn->prepare("
    SELECT 
        ct.*,
        u.username AS host_username,
        u.fullname AS host_fullname,
        u.email AS host_email,
        u.profile_picture AS host_profile_picture
    FROM 
        classroom_table ct
    INNER JOIN 
        users_table u
    ON 
        ct.classroom_host = u.user_id
    WHERE 
        ct.classroom_id = ?
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    ?>

    <?php include 'modal/joinClassroom.php'; ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-nav sticky-top">
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

        <div class="profile container mt-4">
            <!-- Class Header Banner -->
            <div class="class-banner rounded-4 p-4 mb-4 text-white position-relative">
                <h2>Ranking - <?php echo $row['classroom_name'] ?></h2>
                <p class="mb-0">Created by: <?php echo $row['host_fullname']; ?></a></p>
                <button class="btn btn-light position-absolute top-0 end-0 m-3"
                    data-bs-toggle="tooltip"
                    title="Class Information">
                    <i class="bi bi-info-circle"></i>
                </button>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" id="classroom-tab" data-bs-toggle="tab" href="#classroom" style="color: #000;">Classroom</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="rankings-tab" data-bs-toggle="tab" href="#rankings" style="color: #000;">Rankings</a>
                </li>
            </ul>

            <!-- Tab Content -->
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
                                            <span>Calculate GPA</span>
                                        </div>
                                    </div>
                                    <button class="brand-btn" style="height: 40px; margin-top: 20px;" data-bs-toggle="modal" data-bs-target="#gradeInputModal">Open Calculator</button>
                                </div>
                            </div>

                            <!-- Upcoming Section -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Top 3 Students</h6>
                                    <!-- Using PHP loop for ranking list -->
                                    <div class="ranking-list mt-3">
                                        <?php

                                        include 'sql/top3Student.php';

                                        while ($student = $top3->fetch_assoc()) {
                                            echo '<div class="d-flex align-items-center gap-2 mb-2">
                                                <img src="../' . $student['profile_picture'] . '"
                                                    alt="Profile" class="rounded-circle" width="32" height="32">
                                                <div>
                                                    <a href="profile.php?profile=' . $student["top3_id"] . '" class="text-black"><small class="fw-bold d-block">' . $student['fullname'] . '</small></a>
                                                    <small class="text-muted">GPA: ' . $student['student_gpa'] . '</small>
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

                                include 'sql/classroomPost.php';

                                if ($top10 = $post->fetch_assoc()) { ?>
                                    <!-- Achievement Card -->
                                    <div class="achievement-card p-4">
                                        <div class="row align-items-center">
                                            <!-- Left Column: Profile Image -->
                                            <div class="col-md-4 text-center">
                                                <img src="../<?php echo $top10['profile_picture']; ?>"
                                                    alt="Profile"
                                                    class="rounded-circle profile-img  mb-3 mb-md-0"
                                                    width="150"
                                                    height="150">
                                            </div>

                                            <!-- Right Column: Stats and Message -->
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <a href="profile.php?profile=<?php echo $top10['top10_id']; ?>" class="text-black">
                                                            <h4 class="mb-3 ms-2"><?php echo $top10['fullname']; ?></h4>
                                                        </a>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <button class="btn share-btn"
                                                            id = "shareBtn"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Share your achievement">
                                                            <i class="bi bi-share"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-4 mb-3">
                                                    <div class="achievement-stat">
                                                        <h3 class="mb-0"><?php echo $top10['gpa']; ?></h3>
                                                        <small class="text-muted">GPA</small>
                                                    </div>
                                                    <div class="achievement-stat">
                                                        <h3 class="mb-0"><i class="bi bi-trophy-fill me-2"></i><?php echo $top10['rank']; ?></h3>
                                                        <small class="text-muted">Rank</small>
                                                    </div>
                                                </div>

                                                <!-- Congratulatory Message -->
                                                <div class="celebration-message">
                                                    <div class="confetti-bg p-3 rounded-4">
                                                        <h5 class="text-white mb-2">Congratulations!</h5>
                                                        <p class="mb-0 text-white"><?php echo $top10['description']; ?></p>
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
                                                <h5>This is where you' ll see Updates</h5>
                                                <p class="text-muted">Use the stream to view top 10 Students</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rankings Tab -->
                <div class="tab-pane fade" id="rankings">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Class Rankings</h5>
                            <div class="ranking-list">
                                <?php
                                $stmt = $conn->prepare("SELECT 
                                                       cs.classroom_id,
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
                                                       WHERE 
                                                           cs.classroom_id = ?
                                                       ORDER BY 
                                                           cs.classroom_id, rank;");

                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($student = $result->fetch_assoc()) {
                                    echo '<div class="d-flex align-items-center gap-2 gap-md-3 mb-2 mb-md-3 p-1 p-md-2 border rounded">
                                        <span class="fw-bold small-text ms-2">' . $student['rank'] . '</span>
                                        <img src="../' . $student['profile_picture'] . '"
                                            alt="Profile" class="rounded-circle small-avatar" width="48" height="48">
                                        <div class="flex-grow-1">
                                            <a href="profile.php?profile=' . $student["user_id"] . '" class="text-black">
                                                <h6 class="mb-0 small-text">' . $student['fullname'] . '</h6>
                                            </a>
                                            <small class="text-muted smaller-text">GPA: ' . $student['student_gpa'] . '</small>
                                        </div>
                                            <button class="btn share-btn"
                                                id = "secondShare"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Share your achievement">
                                                <i class="bi bi-share"></i>
                                            </button>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'modal/calculator.php'; ?>


</body>

</html>