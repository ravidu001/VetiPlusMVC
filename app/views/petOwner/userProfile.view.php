<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Profile</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/poppinsFont.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/profilePages.css" rel="stylesheet">

    </head>
    <body>
        
        <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?>

        <div class="bodyArea">
            
            <div class="aloneContent profilePage">
                <h1>My Profile</h1>
    
                <div class="profilePicContainer">
                    <?php if (isset($data['profilePicture'])) : ?>
                        <img src="<?= ROOT.'/assets/images/profilePics/petOwner/'.$data['profilePicture'] ?>"
                            alt="Profile Picture">
                    <?php else: ?>
                        <span>No profile picture added.</span>
                    <?php endif; ?>
    
                    <form id="editPetOwnerProfilePic" method="post" enctype="multipart/form-data" class="profilePicEditForm"
                        action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    
                        <input type="hidden" name="formName" value="profilePicEdit">
    
                        <label for="photo">Change Profile Picture:</label>    
                        <input type="file" id="photo" accept="image/*" name="photo" required>
    
                        <button type="submit">Save</button>
                    </form>
    
                </div>
    
                <form id="editPetOwnerDetails" method="post" class="profileDetailsEditForm"
                    action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    
                    <input type="hidden" name="formName" value="profileDetailsEdit">
    
                    <!-- <div class="userData"> -->
                        <label for="name">Name: </label>
                        <span class="display-field"><?= $data['fullName']; ?></span>
                        <input type="text" id="name" class="input-field" name="name" value="<?= $data['fullName']; ?>" required>
                    <!-- </div> -->
    
                    <button type="button" onclick="toggleEdit()">Edit</button>
    
                    <!-- <div class="userData"> -->
                        <label for="contact">Contact Number: </label>
                        <span class="display-field"><?= $data['contactNumber']; ?></span>
                        <input type="number" id="contact" class="input-field" name="contact" value="<?= $data['contactNumber']; ?>" required>
                    <!-- </div> -->
    
                    <!-- <div class="userData"> -->
                        <label for="dob">Date of Birth: </label>
                        <span class="display-field"><?= $data['DOB']; ?></span>
                        <input type="date" id="dob" class="input-field" name="dob" value="<?= $data['DOB']; ?>" required>
                    <!-- </div> -->
                    
                    <!-- <div class="userData"> -->
                        <label for="nic">NIC Number: </label>
                        <span class="display-field"><?= $data['NIC']; ?></span>
                        <input type="text" id="nic" class="input-field" name="nic" value="<?= $data['NIC']; ?>" required>
                    <!-- </div> -->
                    
                    <!-- <div class="userData"> -->
                        <label id="address">Address: </label>
                        <span class="display-field"><?= $data['houseNo'].', '.$data['streetName'].',<br/>'.$data['city']; ?></span>
    
                        <input type="text" id="houseNo" class="input-field" name="houseNo" value="<?= $data['houseNo']; ?>" required>
                        <input type="text" id="streetName" class="input-field" name="streetName" value="<?= $data['streetName']; ?>" required>
                        <input type="text" id="city" class="input-field" name="city" value="<?= $data['city']; ?>" required>
                    <!-- </div> -->
    
                    <button type="submit" style="display: none;" id="save-button">Save</button>
                </form>
    
                <form action="../login-singup/logout.php" method="post">
                    <button type="submit">Logout</button>
                </form>
    
                <!-- <button id="logoutButton">Logout</button> -->
    
            </div>
    
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>
        </div>

        <script>
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

            // petOwner logout
            document.getElementById('logoutButton').addEventListener('click', function () {
                if (confirm('Are you sure you want to logout?')) {
                    fetch('<?= ROOT ?>/client/pages/petOwner/logout.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Successfully logged out.')
                            window.location.href = '<?= ROOT ?>/index.php';
                        } else {
                            alert('Failed to logout. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Logout error:', error);
                        alert('An error occurred while logging out.');
                    });
                }
            });

        </script>
    </body>
</html>