<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="../../assets/images/logo.png" type="image/png"> -->
    <title>VetiPlus Login</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login/style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php echo $notification->display(); ?>
    <div class="container">
        <div class="left-panel">
            
                <div class="home-icon">
                    <a href="guestUser">  <!-- guest user file location-->                   
                        <i class='bx bx-home'></i>
                    </a>
                </div>
            
            <img src="<?= ROOT ?>/assets/images/login/login.png" alt="Pet Illustration" class="illustration">
        </div>
        <div class="gradient">
            <div class="right-panel">
                <div class="login-box">
                    <h2>Welcome to <span class="brand"><br />VetiPlus</span></h2>
                    
                    <div>
                        <?php
                            if(!empty($data)){
                                foreach($data as $message){
                                    echo '<div class="message">'. $message . '</div>';
                                }
                            }
                        ?>
                    </div>
                    
                    <form action="<?= ROOT ?>/Login/login" method="POST" class="login-form">
                        <div class="input-group">
                            <label for="email">
                            <img src="<?= ROOT ?>/assets/images/login/email.png" alt="Email" class="icon">
                            </label>
                            <input type="email" id="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="input-group">
                            <label for="password">
                                <img src="<?= ROOT ?>/assets/images/login/key.png" alt="Password" class="icon">
                            </label>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword()">👁️</span>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                        <button type="submit" class="login-button" name="login">Login</button>
                    </form>
                    <p class="register-prompt">
                        Don’t have an account? <a href="<?= ROOT ?>/signup" class="register-link">Register Now</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/login.js"></script>
</body>
</html>
