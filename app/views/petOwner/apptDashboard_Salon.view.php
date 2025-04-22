<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Salon Appointments</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/cardStyles.css" rel="stylesheet">

        <!-- <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet"> -->

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

        <!-- the css parts for SearchableDropdown -->
        <style>
            .filter-group {
                position: relative;
                margin-bottom: 15px;
                width: 250px;
            }
            .search-input {
                width: 100%;
                padding: 8px;
            }
            
            .dropdown-list {
                position: absolute;
                width: 100%;
                border: 1px solid #ccc;
                border-top: none;
                max-height: 150px;
                overflow-y: auto;
                background: #fff;
                display: none;
                margin: 0;
                padding: 0;
                list-style: none;
            }  
            .dropdown-list li {
                padding: 8px;
                cursor: pointer;
            }  
            .dropdown-list li:hover {
                background: #f0f0f0;
            }
        </style>

    </head>
    <body>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">

        <section class="dashArea">
                <h2>Upcoming Appointment</h2>

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

            
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popup.js"></script>

        <script defer>
            const ROOT = `<?= ROOT ?>`;
            fetchAndAppendCards(
                'PO_apptDashboard_Salon/getAppts_upcoming',
                '.apptUpcomingCard-template',
                '.apptUpcomingCard-container'
            )

            fetchAndAppendCards(
                'PO_apptDashboard_Salon/getAppts_history',
                '.apptHistoryCard-template',
                '.apptHistoryCard-container'
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
                    apptDateTime: card.querySelector('.apptDateTime').textContent
                };

                return cardDetails;
            }
        </script>

    </body>
</html>