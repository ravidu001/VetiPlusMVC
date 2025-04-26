<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Salon Member</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonserviceadd.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/imageupload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
        <a href="<?=ROOT?>/SalonStaff"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
                <h1 class="form-title">Add New Member</h1>
            
            <form id="serviceForum" class="service-form" action= "" method="POST" enctype="multipart/form-data">
                <!-- Salon Member Name -->
                <div class="form-group">
                    <label for="MemberName">
                        <i class="fa-solid fa-user"></i> Salon Member Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="MemberName" 
                           name="MemberName" 
                           placeholder="e.g., Witharana.M.W.P.I"
                           required>
                </div>

                <!-- Telephone Number -->
                <div class="form-group">
                    <label for="PhoneNumber">
                        <i class="fa-solid fa-phone"></i> Phone Number <span class="required">*</span>
                    </label>
                        <input type="number" 
                               id="PhoneNumber" 
                               name="PhoneNumber" 
                               placeholder="0778566395"
                               required>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="memberAddress">
                        <i class="fa-solid fa-location-dot"></i> Address <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="memberAddress" 
                           name="memberAddress" 
                           placeholder="eg-: Rajagiriya,Kolonna"
                           required>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="memberId">
                        <i class="fa-solid fa-id-card-clip"></i> National Identity Number<span class="required">*</span>
                    </label>
                    <input type="number" 
                           id="memberId" 
                           name="memberId" 
                           placeholder="eg-: 200178354966"
                           required>
                </div>

                <!-- Work Status -->
                <div class="form-group">
                    <label for="job">
                        <i class="fa-solid fa-user-check"></i> Work Status
                    </label>
                    <input type="text" 
                           id="job" 
                           name="job" 
                           placeholder="eg-: Treatments for Dogs"
                           required>
                </div>

                <!-- Image Upload Section -->
                <div class="form-group">
                    <label>
                        <i class="fas fa-images"></i> Profile Image
                    </label>
                        <div class="image-upload-box">
                            <div class="image-preview">
                                <img src="/api/placeholder/150/150" alt="Preview" id="preview">
                            </div>
                            <div class="upload-button">
                                <i class="fas fa-upload"></i>
                                <span>Upload Image</span>
                                <input type="file" 
                                       id="image" 
                                       name="photo" 
                                       accept="image/*"
                                       class="file-input">
                            </div>
                        </div>

                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-button" name="submit">
                    <i class="fas fa-plus-circle"></i> Save
                </button>
            </form>
        </div>
    </div>
</body>
    <script src="<?=ROOT?>/assets/js/salon/salonUploadImage.js"></script> 
</html>






















