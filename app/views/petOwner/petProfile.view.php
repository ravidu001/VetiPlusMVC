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

        <link href="<?= ROOT ?>/assets/css/petOwner/profile.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>
        <script> const ROOT = `<?= ROOT ?>`; </script>

        <div class="bodyArea">

            <section class="dashArea">
                <h2>Pet Profile</h2>

                <div class="profileContainer">
                    <div class="profilePicContainer">
                        <div class="pics">
                            <img class="profilePic inProfilePg" alt="Pet Profile Picture"
                                src="<?= ROOT.'/assets/images/petOwner/profilePictures/pet/'.$this->pet_details->profilePicture ?>">
                            
                            <img src="" class="previewImage profilePic inProfilePg" alt="Preview Image" style="display: none;">
                        </div>

                        <form class="profileForm profilePicEditForm" method="post" enctype="multipart/form-data"
                            action="<?= ROOT ?>/PO_petProfile/changePetProfilePicture">
    
                            <button class="profileFormBtn">
                                <label for="profilePicture">Change Profile Picture:</label>    
                            </button>
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" hidden required>
    
                            <div class="errorMsg"></div>
                            
                            <div class="btnContainer">
                                <button class="profileFormBtn" type="reset">Clear</button>
                                <button class="profileFormBtn" type="submit">Save</button>
                            </div>
                        </form>
                    </div>

                    <form id="editPetDetails" method="post" class="profileForm"
                        action="<?= ROOT.'/PO_petProfile/editPetDetails' ?>">
    
                        <div class="formGroup">
                            <strong>Species:</strong>
                            <span class="data"><?= $this->pet_details->species ?></span>
                        </div>
                        <div class="formGroup">
                            <strong>Breed:</strong>
                            <span class="data"><?= $this->pet_details->breed ?></span>
                        </div>

                        <div class="formGroup">
                            <b><label for="name">Name: </label></b>
                            <span class="displayField"><?= $this->pet_details->name ?></span>
                            <input type="text" id="name" class="inputField" name="name"
                                value="<?= $this->pet_details->name ?>" required>
                        </div>
    
                        <div class="formGroup">
                            <b><label for="DOB">Date of Birth: </label></b>
                            <span class="displayField"><?= $this->pet_details->DOB ?></span>
                            <input type="date" id="DOB" class="inputField" name="DOB"
                                value="<?= $this->pet_details->DOB ?>" max="<?= (new DateTime("now"))->format('Y-m-d') ?>" required>
                        </div>

                        <div class="errorMsg"></div>

                        <div class="btnContainer">
                            <button class="profileFormBtn" type="button" onclick="toggleEdit()">Edit</button>
                            <button class="profileFormBtn" type="submit" style="display: none;" id="save-button">Save</button>
                        </div>
                    </form>

                </div>

                <button class="profileFormBtn loneBtn" id="deletePet">Delete Pet Profile</button>

            </section>

            <!-- <section class="dashArea-container"> -->
                <section class="dashArea">
                    <h2>Upcoming Appointments</h2>
                    <div class="longCard-container apptUpcomingCard-container"></div>
                    <template class="apptUpcomingCard-template">
                        <div class="card longCard apptUpcomingCard" type apptID providerID petOwnerID>
                            <div class="cardPic-container">
                                <img src="" alt="providerPic" class="cardPic providerPic">

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

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>

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
        </script>

        <script defer>
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', submitForm);
            })

            document.getElementById('deletePet').addEventListener('click', function() {
                const action =  `PO_petProfile/deletePet`;
                const petID = <?= ($this->petID) ?>;
                displayPopUp('popup_confirm', {someID: petID, action: action})
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
