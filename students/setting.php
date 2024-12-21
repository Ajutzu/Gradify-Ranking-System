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
    <link rel="stylesheet" href="../css/setting.css">
    <link rel="stylesheet" href="../css/userDashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/loginSystem.css">

    <!-- JS -->
    <script src="../js/setting.js" defer></script>
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
            <a href="profile.php?profile=<?php echo $_SESSION['user_id']; ?>" class="nav-item mt-2">
                <i class="bi bi-person"></i>
                Profile
            </a>
            <a href="#" class="nav-item active mt-2">
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

        <div class="container mt-4">
            <!-- Profile Card -->
            <div class="card">
                <div class="cover-photo-container mb-4">
                    <img src="<?php echo '../' . $_SESSION["profile_cover"] ?>" alt="Cover Photo" class="cover-img" id="coverPhotoPreview">
                    <button class="btn brand-btn-outline change-cover-btn" onclick="document.getElementById('coverPhoto').click()">
                        <i class="bi bi-camera-fill"></i> Change Cover
                    </button>
                    <input type="file" id="coverPhoto" name="cover_photo" class="d-none" accept="image/*" onchange="previewCoverPhoto(event)">
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Left Column - Profile Picture -->
                        <div class="col-md-4 text-center border-md-end">
                            <div class="profile-img-container">
                                <img src="<?php echo '../' . $_SESSION["profile_picture"] ?>"
                                    alt="Profile"
                                    class="profile-img-2 mb-3"
                                    width="200"
                                    height="200">
                            </div>
                            <div class="mt-3">
                                <button class="btn brand-btn mb-2 w-100" onclick="document.getElementById('profilePicture').click()">
                                    <i class="bi bi-image me-2"></i>Change Profile Picture
                                </button>
                                <input type="file" id="profilePicture" name="profile_picture" class="d-none" accept="image/*">
                                <small class="text-muted d-block mb-3">Joined: <?php echo date("F j, Y", strtotime($_SESSION["date_created"])); ?>
                                </small>
                            </div>
                        </div>

                        <!-- Right Column - Profile Details -->
                        <div class="col-md-8">
                            <form action="../auth/update_profile.php" method="POST">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Username:</label>
                                        <input type="text" class="form-control" name="username" placeholder="<?php echo $_SESSION['username']; ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="<?php echo $_SESSION['fullname']; ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION['email']; ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Gender:</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                                    <?php echo ($_SESSION['gender'] == 'Male') ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                                    <?php echo ($_SESSION['gender'] == 'Female') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other"
                                                    <?php echo ($_SESSION['gender'] == 'Other') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="other">Other</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Change Password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0" name="password" placeholder="Enter new password (leave blank to keep current)">
                                            <span class="input-group-text bg-transparent border-start-0 password-toggle" role="button">
                                                <i class="bi bi-eye-slash-fill"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn brand-btn">
                                            <i class="bi bi-check-circle me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>