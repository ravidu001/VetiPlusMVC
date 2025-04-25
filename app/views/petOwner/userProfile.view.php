<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Profile</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/profilePages.css" rel="stylesheet">

    </head>
    <body>
        
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">
            
            <div class="dashArea profilePage">
                <h1>My Profile</h1>
    
                <div class="profilePicContainer">
                    <img alt="Profile Picture" class="profilePic"
                        src="<?= ROOT.'/assets/images/petOwner/profilePictures/po_user/'.$this->po_details->profilePicture?>">
    
                    <form method="post" enctype="multipart/form-data" class="profilePicEditForm"
                        action="./PO_userProfile/changeProfilePicture">
    
                        <input type="hidden" name="formName" value="profilePicEdit">
    
                        <label for="profilePicture">Change Profile Picture:</label>
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required>

    
                        <button type="reset">Clear</button>
                        <button type="submit">Save</button>
                    </form>

                    <img src="" class="previewImage profilePic" alt="Preview Image" style="display: none;">
                </div>
    
                <form id="editPetOwnerDetails" method="post" class="profileDetailsEditForm"
                    action="./PO_userProfile/editUserDetails">
    
                    <input type="hidden" name="formName" value="profileDetailsEdit">
    
                    <!-- <div class="userData"> -->
                        <label for="name">Name: </label>
                        <span class="display-field"><?= $this->po_details->fullName; ?></span>
                        <input type="text" id="name" class="input-field" name="name" value="<?= $this->po_details->fullName; ?>" required>
                    <!-- </div> -->
    
                    <button type="button" onclick="toggleEdit()">Edit</button>
    
                    <!-- <div class="userData"> -->
                        <label for="contact">Contact Number: </label>
                        <span class="display-field"><?= $this->po_details->contactNumber; ?></span>
                        <input type="number" id="contact" class="input-field" name="contact" value="<?= $this->po_details->contactNumber; ?>" required>
                    <!-- </div> -->
    
                    <!-- <div class="userData"> -->
                        <label for="dob">Date of Birth: </label>
                        <span class="display-field"><?= $this->po_details->DOB; ?></span>
                        <input type="date" id="dob" class="input-field" name="dob" value="<?= $this->po_details->DOB; ?>" required>
                    <!-- </div> -->
                    
                    <!-- <div class="userData"> -->
                        <label for="nic">NIC Number: </label>
                        <span class="display-field"><?= $this->po_details->NIC; ?></span>
                        <input type="text" id="nic" class="input-field" name="nic" value="<?= $this->po_details->NIC; ?>" required>
                    <!-- </div> -->
                    
                    <!-- <div class="userData"> -->
                        <label id="address">Address: </label>
                        <span class="display-field"><?= $this->po_details->houseNo.', '.$this->po_details->streetName.',<br/>'.$this->po_details->city; ?></span>
    
                        <input type="text" id="houseNo" class="input-field" name="houseNo" value="<?= $this->po_details->houseNo; ?>" required>
                        <input type="text" id="streetName" class="input-field" name="streetName" value="<?= $this->po_details->streetName; ?>" required>
                        <input type="text" id="city" class="input-field" name="city" value="<?= $this->po_details->city; ?>" required>
                    <!-- </div> -->
    
                    <button type="submit" style="display: none;" id="save-button">Save</button>
                </form>
    
                <a href="<?= ROOT ?>/PO_userProfile/logout">
                    <button id="logoutButton">Logout</button>
                </a>
    
            </div>
    
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script>
            // to preview the uploaded image:
            document.getElementById("profilePicture").addEventListener("change", function(event) {
                let file = event.target.files[0];
                let img = document.querySelector(".previewImage");

                if (file) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        img.src = e.target.result;
                        img.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.style.display = "none"; // Hide the image if no file is selected
                    img.src = "";
                }
            });
            document.querySelector('.profilePicEditForm').addEventListener('reset', function() {
                const img = document.querySelector(".previewImage");
                img.style.display = "none"; // Hide the image if no file is selected
                img.src = "";
            });

            function toggleEdit() {
                const displayFields = document.querySelectorAll('.display-field');
                const inputFields = document.querySelectorAll('.input-field');
                const editButton = document.querySelector('button[onclick="toggleEdit()"]')
                const saveButton = document.getElementById('save-button');

                if (editButton.textContent === "Edit") {
                    // Switch to edit mode
                    displayFields.forEach(field => field.style.display = 'none');
                    inputFields.forEach(field => field.style.display = 'inline-block');
                    editButton.textContent = "Cancel";
                    saveButton.style.display = "inline-block";
                }
                else {
                    // Switch back to display mode without saving
                    inputFields.forEach(field => field.style.display = 'none');
                    displayFields.forEach(field => field.style.display = 'inline');
                    editButton.textContent = "Edit";
                    saveButton.style.display = "none";
                }
            }

            const logoutPopObj = {
                status: "success",
                title: "Logout?",
                message: "Are you sure you want to logout from your account?",
                icon: `<?=ROOT?>/assets/images/petOwner/popUpIcons/confirm.png`,
                askConfirm: true,
                confirmPath: 'po_userProfile/logout'
            };
            // document.getElementById('logoutButton').addEventListener('click', () => displayPopUp(logoutPopObj) );

        </script>
    </body>
</html>