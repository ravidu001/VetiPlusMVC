<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Profile</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/profile.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>
        <script> const ROOT = `<?= ROOT ?>`; </script>

        <div class="bodyArea">
            
            <div class="dashArea">
                <h1>My Profile</h1>
    
                <div class="profileContainer">

                    <div class="profilePicContainer profileFormContainer">
                        <div class="pics">
                            <img class="profilePic inProfilePg" alt="Profile Picture"
                                src="<?= ROOT.'/assets/images/petOwner/profilePictures/po_user/'.$this->po_details->profilePicture?>">

                            <img src="" class="previewImage profilePic inProfilePg" alt="Preview Image" style="display: none;">
                        </div>
        
                        <form method="post" enctype="multipart/form-data" class="profileForm profilePicEditForm"
                            action="./PO_userProfile/changeProfilePicture">
        
                            <button class="profileFormBtn">
                                <label for="profilePicture">Change Profile Picture:</label>    
                            </button>
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" hidden required>
    
                            <div class="btnContainer">
                                <button class="profileFormBtn" type="reset">Clear</button>
                                <button class="profileFormBtn" type="submit">Save</button>
                            </div>
                        </form>
    
                    </div>
        
                    <form method="post" class="profileForm" action="./PO_userProfile/editUserDetails">
        
                        <div class="formGroup">
                            <b><label for="fullName">Name: </label></b>
                            <span class="displayField"><?= $this->po_details->fullName; ?></span>
                            <input type="text" id="fullName" class="inputField" name="fullName" value="<?= $this->po_details->fullName; ?>" required>
                        </div>
        
                        <div class="formGroup">
                            <b><label for="contactNumber">Contact Number: </label></b>
                            <span class="displayField"><?= $this->po_details->contactNumber; ?></span>
                            <input type="text" id="contactNumber" class="inputField" name="contactNumber" value="<?= $this->po_details->contactNumber; ?>" min="10" max="10" required>
                        </div>
        
                        <div class="formGroup">
                            <b><label for="DOB">Date of Birth: </label></b>
                            <span class="displayField"><?= $this->po_details->DOB; ?></span>
                            <input type="date" id="DOB" class="inputField" name="DOB" value="<?= $this->po_details->DOB; ?>" required>
                        </div>
                        
                        <div class="formGroup">
                            <b><label id="address">Address: </label></b>
                            <span class="displayField"><?= $this->po_details->houseNo.', '.$this->po_details->streetName.',<br/>'.$this->po_details->city,', ', $this->po_details->district; ?></span>
                            <input type="text" id="houseNo" class="inputField" name="houseNo" value="<?= $this->po_details->houseNo; ?>" required>
                        </div>
                        <div class="formGroup">
                            <span></span>
                            <input type="text" id="streetName" class="inputField" name="streetName" value="<?= $this->po_details->streetName; ?>" required>
                        </div>
                        <div class="formGroup">
                            <span></span>
                            <input type="text" id="city" class="inputField" name="city" value="<?= $this->po_details->city; ?>" required>
                        </div>
                        <div class="formGroup">
                            <span></span>
                            <input type="text" id="district" class="inputField" name="district" value="<?= $this->po_details->district; ?>" required>
                        </div>

                        <div class="errorMsg"></div>
                        <div class="btnContainer">
                            <button class="profileFormBtn" type="button" onclick="toggleEdit()">Edit</button>
                            <button class="profileFormBtn" type="submit" style="display: none;" id="save-button">Save</button>
                        </div>
                    </form>

                    <div class="passWordSection profileFormContainer">
                        <button class="profileFormBtn" onclick="showPasswordChangeForm()"> Change Password </button>

                        <form id="passwordChangeForm"
                            method="post" class="profileForm invisible" action="./PO_userProfile/changePassword">
                            <div class="formGroup">
                                <label for="oldPass">Enter old password:</label>
                                <input type="password" id="oldPass" class="" name="oldPass" placeholder="hello">
                            </div>
                            <div class="formGroup">
                                <label for="newPass">Enter a new password:</label>
                                <input type="password" id=""newPass class="" name="newPass">
                            </div>
                            <div class="formGroup">
                                <label for="confirmPass">Confirm new password:</label>
                                <input type="password" id="confirmPass" class="" name="confirmPass">
                            </div>
                            
                            <div class="errorMsg"></div>
                            <div class="btnContainer">
                                <button class="profileFormBtn" type="reset">Clear</button>
                                <button class="profileFormBtn" type="submit">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
    
                <button id="logoutButton" class="profileFormBtn loneBtn">Logout</button>
    
            </div>
    
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script defer>
            document.querySelectorAll('form').forEach(x => x.addEventListener('submit', submitForm));

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
                const displayFields = document.querySelectorAll('.displayField');
                const inputFields = document.querySelectorAll('.inputField');
                const editButton = document.querySelector('button[onclick="toggleEdit()"]')
                const saveButton = document.getElementById('save-button');

                const editState = (editButton.textContent === "Edit");

                displayFields.forEach(field => field.style.display = editState ? 'none' : 'inline');
                inputFields.forEach(field => field.style.display = editState ? 'inline-block' : 'none');
                editButton.textContent = editState ? "Cancel" : 'Edit';
                saveButton.style.display = editState ? "inline-block" : 'none';
            }

            function showPasswordChangeForm () {
                document.getElementById('passwordChangeForm').classList.toggle('invisible')
            }

            // const logoutPopObj = {
            //     status: "success",
            //     title: "Logout?",
            //     message: "Are you sure you want to logout from your account?",
            //     icon: `<?=ROOT?>/assets/images/petOwner/popUpIcons/confirm.png`,
            //     askConfirm: true,
            //     confirmPath: 'po_userProfile/logout'
            // };
            document.getElementById('logoutButton').addEventListener('click', () => displayPopUp('popup_confirm', {action: 'PO_userProfile/logout'}) );

        </script>
    </body>
</html>