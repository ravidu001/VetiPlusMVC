<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/logo.png" type="image/png">
    <title>VetiPlus Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            
                <div class="home-icon">
                    <a href="../../../index.php">  <!-- guest user file location-->
                        <i class='bx bx-home'></i>
                    </a>
                </div>
            
            <img src="<?= ROOT ?>/assets/images/login/login.png" alt="Pet Illustration" class="illustration">
        </div>
        <div class="gradient">
            <div class="right-panel">
                <div class="login-box">
                    <h2>Sign Up</h2>
                    <div class="sub-heading">
                        Create your account
                    </div>
                    
                    <?php
                        if(!empty($data)){
                            foreach($data as $message){
                                echo '<div class="message">'. $message . '</div>';
                            }
                        }
                    ?>
                    
                    <form action="<?= ROOT ?>/signup/signup" method="POST" class="login-form" enctype="multipart/form-data">

                        <div class="input-group">
                            <label for="email">
                            <img src="<?= ROOT ?>/assets/images/login/email.png" alt="Email" class="icon">
                            </label>
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="input-group">
                            <label for="userType">
                                <img src="<?= ROOT ?>/assets/images/login/type.png" alt="User Type" class="icon">
                            </label>
                            <select id="userType" name="userType" required>
                                <option value="" disabled selected>Select User Type</option>
                                <option value="Pet Owner">Pet Owner</option>
                                <option value="Vet Doctor">Vet Doctor</option>
                                <option value="Vet Assistant">Vet Assistant</option>
                                <option value="Salon">Salon</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="password">
                                <img src="<?= ROOT ?>/assets/images/login/key.png" alt="Password" class="icon">
                            </label>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword()">👁️</span>
                        </div>

                        <div class="input-group">
                            <label for="repassword">
                                <img src="<?= ROOT ?>/assets/images/login/key.png" alt="rePassword" class="icon">
                            </label>
                            <input type="password" id="repassword" name="repassword" placeholder="Re-Password" required>
                            <span class="toggle-repassword" onclick="toggleRePassword()">👁️</span>
                        </div>
                    <!--
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    -->
                        <button type="submit" class="login-button" name="submit"> Sign up</button>
                    </form>
                    <p class="register-prompt">
                        Already have an account? <a href="<?= ROOT ?>/Login" class="register-link">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/login.js"></script>
</body>
</html>
