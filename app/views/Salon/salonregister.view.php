<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Time Render Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonregister.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/common/formdataerror.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
        <?php

            if(!empty($data['errors']))
            {
                foreach($data['errors'] as $message){
                    echo '<div class="message">'. $message . '</div>';
                }
                // show('hiiiiiiiiiiiii');
            }
            show($data);
        ?>
                     
<div class="RendarContent">
<?= $notification->display(); ?>
    
    <!-- I am not set the path yet because the login and sign up page is waiting -->
    <a href="<?=ROOT?>/Login"><i class="fa-solid fa-circle-xmark pageclose"></i></a>

    <form id="salonForum" class="salon-form" action="<?=ROOT?>/SalonRegister" method="POST" enctype="multipart/form-data">
        <div style="display: flex;">
            <div class="rendarpart1">
                <h2>Pet Salon Registration</h2>
                <p>"Enhance your business effortlessly with our platform your ultimate partner for growth and success. "</p>
                <div class="image-container">
                    <img src="<?=ROOT?>/assets/images/salon/register/salon55.png" alt="image" class="salonimage">
                </div>
                    <h3>What is your Salon Name ?</h3>

                    <!-- <form id="salonForum" class="salon-form" action="<?=ROOT?>/SalonRegister" method="post" enctype="multipart/form-data"> -->

                    <style>
                        .message{
                            color: red;
                            font: 20px;
                            background-color:rgb(243, 137, 137);
                        }

                    </style>
                    
            
                <!-- Salon Name -->
                <div class="form-group">
                    <label for="serviceName">
                        <i class="fas fa-paw"></i> Salon Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="salonName" 
                           name="salonName" 
                           placeholder="e.g., VetiPlus"
                           value="<?php 
                                    if (!empty($data['oldemaildata'])) 
                                    {
                                      echo $data['oldemaildata']->name;
                                    }
                            ?>"
                           required>
                           <?php 
                                if (!empty($errors['salonName'])): 
                            ?>
                                <div class="error-message">
                                    <?= htmlspecialchars($errors['salonName']) ?>
                                </div>
                            <?php 
                                endif; 
                            ?>       
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="salonPhoneNumber">
                    <i class="fa-solid fa-phone"></i> Phone Number <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="salonPhoneNumber" 
                           name="salonPhoneNumber" 
                           placeholder="e.g., 077-6399941"
                           pattern="0[0-9]{9}"
                           value="<?php 
                                    if (!empty($data['oldemaildata'])) 
                                    {
                                      echo $data['oldemaildata']->phoneNumber;
                                    }
                            ?>"
                           required>
                           <?php 
                                if (!empty($errors['salonPhoneNumber'])): 
                            ?>
                                <div class="error-message">
                                    <?= htmlspecialchars($errors['salonPhoneNumber']) ?>
                                </div>
                            <?php 
                                endif; 
                            ?>     
                </div>

                 <!-- Address (URL) -->
                <div class="form-group">
                    <label for="location">
                        <i class="fa-solid fa-location-dot"></i> Location<span class="required">*</span>
                    </label>
                    <input type="text" 
                        id="location" 
                        name="location" 
                        placeholder="e.g., Rajaguruwatta,kolonna"
                        
                        value="<?php 
                                    if (!empty($data['oldemaildata'])) 
                                    {
                                      echo $data['oldemaildata']->address;
                                    }
                            ?>" 
                        required>
                        <?php 
                            if (!empty($errors['location'])): 
                        ?>
                                <div class="error-message">
                                    <?= htmlspecialchars($errors['location']) ?>
                                </div>
                        <?php 
                            endif; 
                        ?>     
                </div>
            </div>
            <div class="rendarpart2">
                    <!-- Business Registration Number -->
                        <div class="form-group">
                            <label for="businessregnumber">
                                <i class="fa-solid fa-registered"></i> Business Registration Number <span class="required">*</span>
                            </label>
                            <input type="text" 
                                id="businessregnumber" 
                                name="businessregnumber" 
                                placeholder="e.g., ABC123" 
                                
                                title="Please enter a valid registration number (e.g., ABC123)" 
                                value="<?php 
                                            if (!empty($data['oldemaildata'])) 
                                            {
                                            echo $data['oldemaildata']->BRNumber;
                                            }
                                    ?>"
                                required>
                                <?php if (!empty($errors['businessregnumber'])): ?>
                                    <div class="error-message">
                                        <?= htmlspecialchars($errors['businessregnumber']) ?>
                                    </div>
                                <?php endif; ?>     
                        </div>
                    <h3>BR Certificate(If you have)</h3>
                    <!-- <form id="salonForum" class="salon-form"> -->
                        
                                <div class="image-upload-box">
                                    <div class="image-preview">
                                        <img src="/<?php echo $data['oldemaildata']->BRCertificate ?>" alt="">
                                    </div>
                                    <div class="upload-button">
                                        <i class="fas fa-upload"></i>
                                        <span>Upload Image</span>
                                        <input type="file"
                                            id="image1"
                                            name="brcertificate"
                                            accept="image/*"
                                            class="file-input">
                                    </div>
                                    
                                    <?php if (!empty($errors['image_size'])): ?>
                                        <div class="error-message">
                                            <?= htmlspecialchars($errors['image_size']) ?>
                                        </div>
                                    <?php endif; ?>     
                                </div>
                        

                        <input type="checkbox">
                            <p>
                                Check the integration and agree....
                            </p>
                        <br>
                        
                        <!-- <input type="submit" class="submit-button" name="submit" value="Submit"> -->
                         <button type="submit" class="submit-button" name="submit" value="submit">Submit</button>

                         <br>

                        <p>
                            Thank you for choosing to join our system! 
                            Please provide accurate dataand information. 
                            If you encounter any issues, inform us and 
                            allow a fewminutes for us to verify your details 
                            and register your salon. We willsend you an acceptance 
                            message shortly.
                        </p>

                        <h2>Thank you once again for being a part of our community!</h2>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </form>

    
    <!-- <div class="rendarpart2">
            <h3>BR Certificate(If you have)</h3>
            <form id="salonForum" class="salon-form">
                
                        <div class="image-upload-box">
                            <div class="image-preview">
                                <img src="/api/placeholder/150/150" alt="Preview " id="preview1">
                            </div>
                            <div class="upload-button">
                                <i class="fas fa-upload"></i>
                                <span>Upload Image</span>
                                <input type="file"
                                       id="image1"
                                       name="brcertificate"
                                       accept="image/*"
                                       class="file-input">
                            </div>
                        </div>
                 

                 <input type="checkbox"><p>Check the integration and agree....</p>
                <br>
                Submit Button
                <input type="submit" class="submit-button" name="submit" value="Submit">
                    
                </button> <br>

                <p>
                    Thank you for choosing to join our system! 
                    Please provide accurate dataand information. 
                    If you encounter any issues, inform us and 
                    allow a fewminutes for us to verify your details 
                    and register your salon. We willsend you an acceptance 
                    message shortly.
                </p>

                <h2>Thank you once again for being a part of our community!</h2>
            </form>
    </div> -->
</div>
</body>
    <script src="<?=ROOT?>/assets/js/salon/salonUploadImage.js"></script>  
</html>