<!DOCTYPE html>
<html lang="en">

<?php include '../config/cdn.php'; ?>

<?php include 'sql/getList.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $classroom['classroom_name']; ?> | Class Rankings</title>

    <!-- Website Icon -->
    <link rel="icon" href="../images/ico.svg">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="guest.css">

    <!-- OG -->
    <meta property="og:title" content="<?php echo $classroom['classroom_name']; ?>">
    <meta property="og:description" content="<?php echo 'The GPA of' . $classroom['classroom_name'] . 'this is the list of students and their gpa';?>">
    <!-- <meta property="og:url" content="https://gradify.likesyou.org/guest/guest.php?id=<?php // echo $_GET['classroom_id']?>"> -->
    <meta property="og:type" content="website">

    <!-- JS -->
    <script src="guest.js" defer></script>
    <script src="../js/script.js" defer></script>

</head>

<body>
    <div class="container-fluid vh-100 bg-gradient shadow-sm bg-white">
        <div class="container-fluid p-2">
            <div class="row">
                <div class="col-3 text-center d-md-block d-none">
                    <img src="../images/logo.png" class="img-fluid logo" style="width: 200px;">
                </div>
                <div class="col-md-9 col-12">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="animated-title fw-bolder"><?php echo $classroom['classroom_name']; ?></h1>
                        </div>
                        <div class="col-12 pt-3 pb-2 rounded" style="background-color: var(--pallete-5);">
                            <h6 class="fw-light text-white">Class Rankings</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-2" style="overflow: auto; height: 85vh;">
            <?php
            $result->data_seek(0);
            $i = 0;
            while ($student = $result->fetch_assoc()) {
                $rowBgColor = $i % 2 == 0 ? "#f8f9fa" : "#ffffff";

                echo '
                    <div class="d-flex align-items-center mb-3 p-3 rounded shadow-sm" style="background-color: ' . $rowBgColor . ';">
                        <div class="d-flex align-items-center justify-content-center" style="min-width: 50px;">
                            <span class="fw-bold rank-color"> RANK ' . $student['rank'] . '</span>
                        </div>
                        <img src="../'. $student['profile_picture'] .'" alt="Profile" class="rounded-circle profile" width="48" height="48" style="margin: 0 15px;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 text-truncate">' . $student['fullname'] . '</h6>
                            <small class="text-muted">GPA: ' . $student['student_gpa'] . '</small>
                        </div>
                        <div class="ms-auto">';

                // Check the GPA and display the corresponding status
                if ($student['student_gpa'] > 3.0000) {
                    echo '<p class="text-danger"><i class="bi bi-x-circle"></i> Failed</p>';
                } elseif ($student['student_gpa'] == 0) {
                    echo '<p class="text-secondary"><i class="bi bi-question-circle"></i> Unavailable</p>';
                } else {
                    echo '<p class="text-success"><i class="bi bi-check-circle"></i> Passed</p>';
                }

                echo '
                        </div>
                    </div>';
                $i++;
            }
            ?>
        </div>

    </div>

    <div class="ad-section shadow-lg ad-section-style p-4" id="adSection">
        <div class="text-end">
            <button class="btn btn-close" onclick="closeAd()"></button>

        </div>
        <h5 class="text-bounce">Want to Join Gradify?</h5>
        <p>Sign up now and join your classroom!</p>
        <a href="../auth/frontend/register.php" class="btn brand-btn">Join Now</a>
    </div>

</body>

</html>