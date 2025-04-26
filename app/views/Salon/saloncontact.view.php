<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetiPlus Contact Us</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salon/saloncontact.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>
<body>
    <?= $notification->display(); ?>

    <?php 
        include __DIR__ . '/../navbar/salonnav.php'; 
    ?>
    <?php
        $email = $_SESSION['SALON_USER'];
    ?>
    <div class="home">
    <div class="contact-container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <div class="contact-details">
                    <div class="contact-item">
                        <i class='bx bxs-envelope'></i>
                        <div>
                            <h3>Email</h3>
                            <p>support@vetiplus.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class='bx bxs-phone-call'></i>
                        <div>
                            <h3>Phone</h3>
                            <p>+94 77 987 6543</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class='bx bxl-twitter'></i>
                        <div>
                            <h3>Twitter</h3>
                            <a href ="https://www.twitter.com/VetiPlus" target="_blank">@VetiPlus</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class='bx bxl-facebook-circle'></i>
                        <div>
                            <h3>Facebook</h3>
                            <a href="https://www.facebook.com/VetiPlus" target="_blank">Veti Plus</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2>Send us a Message</h2>
                <form action="<?=ROOT?>/SalonContact" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="email">Email</label> -->
                            <input type="hidden" id="email" name="email" value = "<?= $email ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="messageType">Message Type</label>
                            <select id="messageType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Inquiry">Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div id="messageContainer" class="form-group" style="display:none;">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
                    </div>

                    <div id="ratingContainer" class="form-group" style="display:none;">
                        <label>Rating</label>
                        <div class="rating">
                            <input type="radio" name="rate" id="rate-5" value="5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4" value="4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3" value="3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2" value="2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1" value="1">
                            <label for="rate-1" class="fas fa-star"></label>
                        </div>
                    </div>

                    <div id="uploadContainer" class="form-group" style="display:none;">
                        <label for="imageUpload">Upload Image</label>
                        <div class="file-upload">
                            <input type="file" id="imageUpload" name="image" accept="image/*">
                            <span class="file-upload-text">Choose file</span>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="contactSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/salon/saloncontact.js"></script>
</body>
</html>