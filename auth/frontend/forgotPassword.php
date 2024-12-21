<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradify | GPA Ranker</title>

    <?php include '../../config/cdn.php'; ?>

    <!-- Website Icon -->
    <link rel="icon" href="../../images/ico.svg">

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/loginSystem.css">
    
    <!-- JavaScript -->
    <script src="../../js/script.js" defer></script>


</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Section - Illustration -->
            <div class="col-md-6 illustration-container" data-aos="fade-right" data-aos-duration="1000">
                <img src="../../images/backgroundlogin.png" alt="illustration" class="img-fluid ">
            </div>

            <!-- Right Section - Login Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center position-relative">
                <!-- Added logo at top left -->
                <div class="logo position-absolute top-0 start-0 p-4" data-aos="fade-down" data-aos-duration="1000">
                    <img src="../../images/logo.png" alt="Gradify Logo" height="40">
                </div>

                <div class="login-form mt-sm-5" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                    <h2 class="text-center mb-4 fw-bold">
                        <img src="../../images/ico.svg" alt="wave" class="welcome-wave img-fluid" style="width: 40px">
                        Forgot Your Password?
                    </h2>
                    <p class="text-center text-muted mb-4">Enter Your Email and We Will Send You a Link to Reset Your Password</p>
                    <form action="" method="POST">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="bi bi-envelope-fill text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0" name="email" placeholder="Enter Your Email" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="g-recaptcha mb-4 d-inline-block" data-sitekey="6LdGiUsqAAAAAB7_dNNbqhcLQIS-Z1sQuw13QzG9"></div>
                        </div>
                        <button type="submit" class="brand-btn mb-4">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Send Reset Link
                        </button>
                        <p class="text-center mb-0">
                            Remember Your Password?
                            <a href="../../index.php" class="text-decoration-none">
                                <i class="bi bi-emoji-smile"></i> Login Your Account
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>