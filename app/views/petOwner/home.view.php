<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PetOwner - Dashboard</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/cardStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
    
    </head>

    <body>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <!-- actual content: -->
        <div class="bodyArea">
            <h1 class="bodyHeader">Welcome!</h1>

            <div class="card longCard">
                <img class="profilePic" alt="Profile picture"
                    src="<?= ROOT.'/assets/images/petOwner/profilePictures/po_user/'.$this->po_details->profilePicture?>">
                <span>
                    <h3>Welcome back!</h3>
                    <p><?= $this->po_details->fullName ?></p>
                </span>

            </div>

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
                        <!-- <div class="cardBtn-container">
                            <button class="cardBtn editBtn"><i class="bx bxs-edit bx-sm"></i> Edit</button>
                            <button class="cardBtn rescheduleBtn"><i class="bx bxs-calendar-edit bx-sm"></i> Reschedule</button>
                            <button class="cardBtn cancelBtn"><i class="bx bxs-trash bx-sm"></i> Cancel Appointment</button>
                        </div> -->
                    </div>
                </template>
            </section>

            <section class="dashArea">
                <h2 class="dashHeader">My Pets</h2>

                <div class="tallCard-container pets-container"></div>
                <template class="petCard-template">
                    <a href="" title="Go to Pet Profile Page." class="card tallCard petCard">
                        <img src="" class='petCardPic profilePicture' alt='Pet Image'>
                        <h3 class="name"></h3>
                    </a>
                </template>
                <template class="registerPet-template">
                    <a href="po_petRegister" title="Go to Pet Profile Page." class="card tallCard petCard">
                        <p><i class="bx bxs-plus-circle bx-lg"></i></p>
                        <p>Register pet</p>
                    </a>
                </template>
            </section>

            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>

        </div>

        
        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popup.js"></script>

        <script defer>
            const ROOT = `<?= ROOT ?>`;

            // to populate the pets-container with pet cards:
            const cardTemplate = document.querySelector('.petCard-template');
            const petsContainer = document.querySelector('.pets-container');

            fetch('PO_home/getPets')
            .then(result => result.json())
            .then(data => {
                // if no pets found, no need for mapping:
                if (data.petCount == 0) return;

                data.map(pet => {
                    const card = cardTemplate.content.cloneNode(true).children[0];
                
                    card.setAttribute('href', `po_petProfile?petID=${pet.petID}`)
                    card.querySelector('.profilePicture').src = 
                        `<?=ROOT.'/assets/images/petOwner/profilePictures/pet/' ?>${pet.profilePicture}`;
                    card.querySelector('.name').textContent = pet.name;

                    petsContainer.append(card)
                })
            })
            .finally(() => {
                const regCardTemplate = document.querySelector('.registerPet-template');
                const regCard = regCardTemplate.content.cloneNode(true).children[0];
                petsContainer.append(regCard);
            })


            fetchAndAppendCards (
                'PO_home/getAppts_upcoming',
                '.apptUpcomingCard-template',
                '.apptUpcomingCard-container'
            );

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
