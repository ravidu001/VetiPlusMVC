<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Profile</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">


        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/profilePages.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/formStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet">

    </head>
    <body>
        <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?>

        <div class="bodyArea">

            <section class="dashArea">
                <h2>Pet Profile</h2>

                <div class="profilePicContainer">
                    <img src="<?= ROOT.'/assets/images/profilePics/pet/'.$data['profilePicture'] ?>"
                        alt="Pet Profile Picture">

                    <form id="editPetProfilePic" method="post" enctype="multipart/form-data" class="profilePicEditForm"
                        action="<?= ROOT.'/server/controllers/petOwner/petProfile/editPetProfilePic.php' ?>">

                        <label for="profilePicture">Change Profile Picture:</label>    
                        <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required>

                        <button type="submit">Save</button>
                    </form>

                </div>

                <form id="editPetDetails" method="post" class="profileDetailsEditForm"
                    action="<?= ROOT.'/server/controllers/petOwner/petProfile/editPetDetails.php' ?>">

                    <label for="name">Name: </label>
                    <span class="display-field"><?= $data['name']; ?></span>
                    <input type="text" id="name" class="input-field" name="name" value="<?= $data['name']; ?>" required>

                    <button type="button" onclick="toggleEdit()">Edit</button>
                    
                    <label for="dob">Date of Birth: </label>
                    <span class="display-field"><?= $data['DOB']; ?></span>
                    <input type="text" id="dob" class="input-field" name="dob" value="<?= $data['DOB']; ?>" max="<?= (new DateTime("now"))->format('Y-m-d') ?>" required>
                   
                    <label>Available for breeding: </label>
                    <span class="display-field"><?= $data['breedAvailable'] ? 'Yes': 'No'; ?></span>
                    <span>
                        <label for="breedAvailYes" class="input-field">Yes</label>
                            <input type="radio" id="breedAvailYes" class="input-field" name="breedAvailable" value="1"
                                <?= $data['breedAvailable'] ? 'checked': ''; ?> required onchange="toggleBreedDescription()">
                        <label for="breedAvailNo" class="input-field">No</label>
                            <input type="radio" id="breedAvailNo" class="input-field" name="breedAvailable" value="0"
                                <?= !$data['breedAvailable'] ? 'checked': ''; ?> required onchange="toggleBreedDescription()">
                    </span>
                   
                    <label for="breedDescription">Description for breeding your pet:</label>
                    <span class="display-field"><?= $data['breedAvailable'] ? $data['breedDescription']: "Not-applicable"; ?></span>
                        <textarea name="breedDescription" id="breedDescription" class="input-field" cols="30" rows="5" style="resize: none; display:none;"
                            <?= !$data['breedAvailable'] ? 'disabled': ''; ?> required>
                            <?= $data['breedDescription']; ?>
                        </textarea>
                    
                    <button type="submit" style="display: none;" id="save-button">Save</button>
                </form>

                <div class="unchangingData">
                    <div class="dataContainer">
                        <span class="field"><b>Species:</b></span>
                        <span class="data"><?= $data['species']; ?></span>
                    </div>
                    
                    <div class="dataContainer">
                        <span class="field"><b>Breed:</b></span>
                        <span class="data"><?= $data['breed']; ?></span>
                    </div>
                </div>

                <button id="deletePet" class="loneBtn">Delete Pet Profile</button>

            </section>

            <section class="dashArea">
                <h2>Appointment History</h2>
                <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <span>Full Bath - Mr.Perera</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.06.2024 | 6:00PM</h4>
                            </div>
                            <button><i class="bx bxs-star bx-md"></i> Rate Appointment</button>
                        </div>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <span>Nail Cutting - Miss.Rajamani</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.10.2024 | 6:00PM</h4>
                            </div>
                            <div class="Rating">
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star-half bx-sm"></i>
                                <i class="bx bx-star bx-sm"></i>
                            </div>
                        </div>
            </section>

            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

        </div>


        <script>
            const breedText = document.getElementById('breedDescription')
            function toggleBreedDescription() {
                if (document.getElementById('breedAvailYes').checked) {
                    breedText.disabled = false
                } else if (document.getElementById('breedAvailNo').checked) {
                    breedText.disabled = true
                }
            }

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
        </script>
    </body>
</html>
