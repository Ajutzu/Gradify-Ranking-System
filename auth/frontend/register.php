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
                <img src="../../images/backgroundregister.png" alt="illustration" class="img-fluid ">
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
                        Join Gradify!
                    </h2>
                    <p class="text-center text-muted mb-4">Create Your Account Now Find your Class Rank</p>

                    <form action="../backend/register.php" method="POST" id="registrationForm">
                        <!-- Step 1 -->
                        <div class="step" id="step1">
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
                                        <i class="bi bi-envelope-fill text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0" name="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-person-fill text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" name="fullname" placeholder="Your Full Name" required>
                                </div>
                            </div>
                            <button type="button" class="brand-btn mb-4" onclick="nextStep(1, 2)">
                                Next <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>

                        <!-- Step 2 -->
                        <div class="step" id="step2" style="display: none;">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control border-start-0 border-end-0"
                                        name="password"
                                        placeholder="Enter Your Password"
                                        style="font-size: 0.9rem; color: #495057;"
                                        required>
                                    <span class="input-group-text bg-transparent border-start-0 password-toggle" role="button">
                                        <i class="bi bi-eye-slash-fill text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control border-start-0 border-end-0"
                                        name="confirm_password"
                                        placeholder="Confirm Your Password"
                                        style="font-size: 0.9rem; color: #495057;"
                                        required>
                                    <span class="input-group-text bg-transparent border-start-0 password-toggle" role="button">
                                        <i class="bi bi-eye-slash-fill text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-transparent">
                                        <i class="bi bi-gender-ambiguous text-muted"></i>
                                    </span>
                                    <div class="form-control border-0 d-flex align-items-center gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                            <label class="form-check-label" style="font-size: 0.9rem;" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                            <label class="form-check-label" style="font-size: 0.9rem;" for="female">Female</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                                            <label class="form-check-label" style="font-size: 0.9rem;" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="g-recaptcha mb-4 d-inline-block" data-sitekey="6LdGiUsqAAAAAB7_dNNbqhcLQIS-Z1sQuw13QzG9"></div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="brand-btn mb-4 d-flex align-items-center gap-2"
                                    onclick="prevStep(2, 1)">
                                    <i class="bi bi-arrow-left"></i> Previous
                                </button>
                                <button type="submit"
                                    class="brand-btn mb-4 d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-in-right"></i> Sign Up
                                </button>
                            </div>
                        </div>

                        <p class="text-center mb-0">
                            Already have an account?
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