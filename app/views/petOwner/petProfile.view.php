<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Profile</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/cardStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

        <!-- <link href="<?= ROOT ?>/assets/css/petOwner/profilePages.css" rel="stylesheet"> -->
        <!-- <link href="<?= ROOT ?>/assets/css/petOwner/formStyles.css" rel="stylesheet"> -->

    </head>
    <body>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">

            <section class="dashArea">
                <h2>Pet Profile</h2>

                <div class="profilePicContainer">
                    <img class="profilePic" alt="Pet Profile Picture"
                        src="<?= ROOT.'/assets/images/petOwner/profilePictures/pet/'.$this->pet_details->profilePicture ?>">

                    <form id="changePetProfilePicture" method="post" enctype="multipart/form-data"
                        action="<?= ROOT ?>/PO_petProfile/changePetProfilePicture">

                        <label for="profilePicture">Change Profile Picture:</label>    
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required>

                            <!-- <img class="previewImage" src="" alt="Image Preview"> -->
                            
                        <button type="submit">Save</button>

                    </form>
                </div>

                <form id="editPetDetails" method="post" class="profileDetailsEditForm"
                    action="<?= ROOT.'/PO_petProfile/editPetDetails' ?>">

                    <label for="name">Name: </label>
                    <span class="display-field"><?= $this->pet_details->name ?></span>
                    <input type="text" id="name" class="input-field" name="name" value="<?= $this->pet_details->name ?>" required>

                    <button type="button" onclick="toggleEdit()">Edit</button>
                    
                    <label for="DOB">Date of Birth: </label>
                    <span class="display-field"><?= $this->pet_details->DOB ?></span>
                    <input type="text" id="DOB" class="input-field" name="DOB" value="<?= $this->pet_details->DOB ?>" max="<?= (new DateTime("now"))->format('Y-m-d') ?>" required>
                   
                    <!-- <label>Available for breeding: </label>
                    <span class="display-field"><?= $this->pet_details->breedAvailable ? 'Yes': 'No'; ?></span>
                    <span>
                        <label for="breedAvailYes" class="input-field">Yes</label>
                            <input type="radio" id="breedAvailYes" class="input-field" name="breedAvailable" value="1"
                                <?= $this->pet_details->breedAvailable ? 'checked': ''; ?> required onchange="toggleBreedDescription()">
                        <label for="breedAvailNo" class="input-field">No</label>
                            <input type="radio" id="breedAvailNo" class="input-field" name="breedAvailable" value="0"
                                <?= !$this->pet_details->breedAvailable ? 'checked': ''; ?> required onchange="toggleBreedDescription()">
                    </span> -->
                   
                    <label for="breedDescription">Description for breeding your pet:</label>
                    <span class="display-field"><?= $this->pet_details->breedAvailable ? $this->pet_details->breedDescription : "Not-applicable"; ?></span>
                        <textarea name="breedDescription" id="breedDescription" class="input-field" cols="30" rows="5" style="resize: none; display:none;"
                            <?= !$this->pet_details->breedAvailable ? 'disabled': ''; ?> required>
                            <?= $this->pet_details->breedDescription; ?>
                        </textarea>
                    
                    <button type="submit" style="display: none;" id="save-button">Save</button>
                </form>

                <div class="unchangingData">
                    <div class="dataContainer">
                        <span class="field"><b>Species:</b></span>
                        <span class="data"><?= $this->pet_details->species ?></span>
                    </div>
                    
                    <div class="dataContainer">
                        <span class="field"><b>Breed:</b></span>
                        <span class="data"><?= $this->pet_details->breed ?></span>
                    </div>
                </div>

                <button id="deletePet" class="loneBtn">Delete Pet Profile</button>


                        <!-- <label for="breedAvailNo">Is your pet available for breeding?</label>
                        <span>
                            <label for="breedAvailYes" class="radioLabel">Yes</label>
                                <input type="radio" id="breedAvailYes" name="breedAvailable" value="1" required onchange="toggleBreedDescription()">
                            <label for="breedAvailNo" class="radioLabel">No</label>
                                <input type="radio" id="breedAvailNo" name="breedAvailable" value="0" selected required onchange="toggleBreedDescription()">
                        </span> -->
        
                        <!-- <label for="breedDescription" class="breedDesc" id="breedDescriptionLabel" style="display:none;">Provide a description for breeding your pet:</label>
                            <textarea name="breedDescription" id="breedDescription" class="breedDesc input-field"
                                cols="30" rows="5" style="resize: none; display:none;" required>
                            </textarea> -->
        
        

            </section>

            <!-- <section class="dashArea-container"> -->
                <section class="dashArea">
                    <h2>Upcoming Appointments</h2>
                    <div class="longCard-container apptUpcomingCard-container"></div>
                    <template class="apptUpcomingCard-template">
                        <div class="card longCard apptUpcomingCard" type apptID providerID petOwnerID>
                            <div class="cardPic-container">
                                <img src="" alt="providerPic" class="cardPic providerPic">
                                <img src="" alt="petPic" class="cardPic petPic">

                            </div>
                            <div class="cardDetails">
                                <h4 class="petName"></h4>
                                <span class="providerName"></span>
                                <span class="reason"></span>
                                <span class="petName"></span>
                                <h4 class="apptDateTime"></h4>
                            </div>
                            <div class="cardBtn-container">
                                <button class="cardBtn editBtn"><i class="bx bxs-edit bx-sm"></i> Edit</button>
                                <button class="cardBtn rescheduleBtn"><i class="bx bxs-calendar-edit bx-sm"></i> Reschedule</button>
                                <button class="cardBtn cancelBtn"><i class="bx bxs-trash bx-sm"></i> Cancel Appointment</button>
                            </div>
                        </div>
                    </template>
                </section>

                <section class="dashArea">
                    <h2>Appointment History</h2>
    
                    <div class="longCard-container apptHistoryCard-container"></div>
                    <template class="apptHistoryCard-template">
                        <div class="card longCard apptHistoryCard" type apptID providerID petOwnerID>
                            <div class="cardPic-container">
                                <img src="" alt="providerPic" class="cardPic providerPic">
                                <img src="" alt="petPic" class="cardPic petPic">
                            </div>
                            <div class="cardDetails">
                                <h4 class="petName"></h4>
                                <span class="providerName"></span>
                                <span class="reason"></span>
                                <span class="petName"></span>
                                <h4 class="apptDateTime"></h4>
                            </div>
                            <div class="cardBtn-container">
                                <div class="rating loneBtn-container"></div>
                                
                                <button class="cardBtn ratingBtn"><i class="bx bxs-edit bx-sm"></i> Rate Appointment </button>
                            </div>
                        </div>
                    </template>
    
                </section>
            <!-- </section> -->

            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>

        </div>
        
        <script>
            const ROOT = <?php echo json_encode(ROOT); ?>;
        </script>

        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>

        <script>
            // const breedText = document.getElementById('breedDescription')
            // function toggleBreedDescription() {
            //     if (document.getElementById('breedAvailYes').checked) {
            //         breedText.disabled = false
            //     } else if (document.getElementById('breedAvailNo').checked) {
            //         breedText.disabled = true
            //     }
            // }

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

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script>
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', submitForm);
            })

            document.getElementById('deletePet').addEventListener('click', function() {
                const action =  `${ROOT}/PO_petProfile/deletePet`;
                // try
                displayPopUp('popup_deletePet', cardDetailsObj);
            })

            fetchAndAppendCards (
                'PO_petProfile/getPetApptHistory',
                '.apptHistoryCard-template',
                '.apptHistoryCard-container'
            )
            fetchAndAppendCards (
                'PO_petProfile/getPetApptUpcoming',
                '.apptUpcomingCard-template',
                '.apptUpcomingCard-container'
            )

            document.querySelector('.apptHistoryCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails(button);
                    (button.classList.contains('ratingBtn')) && displayPopUp('popup_feedback', cardDetailsObj);
                }
            })

            document.querySelector('.apptUpcomingCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails(button);
                    (button.classList.contains('editBtn')) && displayPopUp('popup_editAppt', cardDetailsObj);
                    (button.classList.contains('rescheduleBtn')) && displayPopUp('popup_rescheduleAppt', cardDetailsObj);
                    (button.classList.contains('cancelBtn')) && displayPopUp('popup_cancelAppt', cardDetailsObj);
                }
            })
            
            // get details from the closest card class into an object and return it:
            function getCardDetails (btn) {
                const card = btn.closest('.card');

                const cardDetails = {
                    type: card.getAttribute('type'),
                    apptID: card.getAttribute('apptID'),
                    providerID: card.getAttribute('providerID'),
                    petOwnerID: card.getAttribute('petOwnerID'),

                    providerName: card.querySelector('.providerName').textContent,
                    reason: card.querySelector('.reason').textContent,
                    petName: card.querySelector('.petName').textContent,
                    apptDateTime: card.querySelector('.apptDateTime').textContent,
                    action: `${ROOT}/PO_petProfile/postFeedback`
                };

                return cardDetails;
            }
        </script>
    </body>
</html>
