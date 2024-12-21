<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradify | GPA Ranker</title>

    <?php include 'config/cdn.php'; ?>

    <!-- Website Icon -->
    <link rel="icon" href="../images/ico.svg">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/loginSystem.css">

    <!-- JavaScript -->
    <script src="../js/script.js" defer></script>

</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Section - Illustration -->
            <div class="col-md-6 illustration-container" data-aos="fade-right" data-aos-duration="1000">
                <img src="images/backgroundlogin.png" alt="illustration" class="img-fluid ">
            </div>

            <!-- Right Section - Login Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center position-relative">
                <!-- Added logo at top left -->
                <div class="logo position-absolute top-0 start-0 p-4" data-aos="fade-down" data-aos-duration="1000">
                    <img src="images/logo.png" alt="Gradify Logo" height="40">
                </div>

                <div class="login-form mt-sm-5" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                    <h2 class="text-center mb-4 fw-bold">
                        <img src="images/ico.svg" alt="wave" class="welcome-wave img-fluid" style="width: 40px">
                        Hey There, Welcome Back!
                    </h2>
                    <p class="text-center text-muted mb-4">Join Classroom, Input Your Grades, and Check Your Rank</p>
                    <form action="auth/backend/login.php" method="POST">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="bi bi-person-fill text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" name="username" placeholder="Your Username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="bi bi-lock-fill text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 border-end-0" name="password" placeholder="Your Password" required>
                                <span class="input-group-text bg-transparent border-start-0 password-toggle" role="button">
                                    <i class="bi bi-eye-slash-fill text-muted"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-4 text-end">
                            <a href="auth/frontend/forgotPassword.php" class="text-decoration-none">
                                <i class="bi bi-question-circle-fill"></i>
                                Forgot Password?
                            </a>
                        </div>
                        <div class="text-center">
                            <div class="g-recaptcha mb-4 d-inline-block" data-sitekey="6LdGiUsqAAAAAB7_dNNbqhcLQIS-Z1sQuw13QzG9"></div>
                        </div>
                        <button type="submit" class="brand-btn mb-4">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Let's Get Started!
                        </button>
                        <p class="text-center mb-0">
                            First time here?
                            <a href="auth/frontend/register.php" class="text-decoration-none">
                                <i class="bi bi-emoji-smile"></i> Create Your Free Account
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>