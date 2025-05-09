<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Pending</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/register/pending.css">

</head>
<body>
    <div class="pending-container">
        <div class="pending-icon">⏳</div>
        <h2 class="pending-title">Registration Pending</h2>
        <p class="pending-description">
            Your registration is currently under review by our admin team. 
            We appreciate your patience while we process your request.
        </p>
        
        <div class="status-indicator">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div class="loginredirect">
            <p>Please try again after the oneday. Admin checking your details.</p>
            <button class="login">
                <a href="<?=ROOT?>/Login">Login</a>
            </button>
        </div>

        <div class="contact-info">
            <p>If you have any questions, please contact support at support@vetiplus.com</p>
        </div>
    </div>

    <script>
        // Optional: Add any additional interactivity or dynamic content here
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Pending page loaded');
        });
    </script>
</body>
</html>