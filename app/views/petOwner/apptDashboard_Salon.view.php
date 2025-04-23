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
        
        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">


    </head>
    <body>

        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <script>
            const ROOT = `<?= ROOT ?>`;
            // get details from the closest card class into an object and return it:
            function getCardDetails_appt (btn) {
                let formAction;
                if (btn.classList.contains('editBtn'))
                    formAction = 'PO_apptDashboard_Vet/editAppt';
                else if (btn.classList.contains('rescheduleBtn'))
                    formAction = 'PO_apptDashboard_Vet/bookAppt';
                else if (btn.classList.contains('cancelBtn'))
                    formAction = 'PO_apptDashboard_Vet/rateAppt';
                else if (btn.classList.contains('ratingBtn'))
                    formAction = 'PO_apptDashboard_Vet/rateAppt';
                
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
                    action: formAction
                };

                return cardDetails;
            }
        </script>

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
                            <!-- <button class="cardBtn editBtn"><i class="bx bxs-edit bx-sm"></i> Edit</button> -->
                            <button class="cardBtn rescheduleBtn" title="Reschedule appointment to another time.">
                                <i class="bx bxs-calendar-edit bx-sm"></i> Reschedule</button>
                            <button class="cardBtn cancelBtn" title="Cancel the appointment.">
                                <i class="bx bxs-trash bx-sm"></i> Cancel Appointment</button>
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

            <section class="dashArea">
                <h2>Search Available Vet Sessions</h2>

                <div class="searchFilter-container">
                    <div class="filter-group" id="docNameFilter">
                        Search by a salon's name:
                        <input type="text" name="salonName" class="searchBar" placeholder="Search by a salon's Name.">
                        <ul class="dropdownList"></ul>
                    </div>
                    
                    <div class="filter-group" id="districtFilter">
                        Search by district:
                        <input type="text" name="district" class="searchBar" placeholder="Search by district.">
                        <ul class="dropdownList"></ul>
                    </div>

                    <button class="cardBtn clearBtn"><i class="bx bxs-clear bx-sm"></i>Clear</button>
                </div>

                <div class="longCard-container availSessCard-container"></div>
                <template class="availSessCard-template">
                    <div class="card sessionCard availSessCard" salonID>
                        <div class="cardPic-container">
                            <img src="" alt="providerPic" class="cardPic providerPic">
                        </div>
                        <div class="cardDetails">
                            <p>
                                <span class="name" style="font-weight: 800; font-size: 1.3em;"></span>
                                Specializing in <span class="salonType"></span>
                            </p>
                            <p class="details"></p>
                            <div class="avgRating loneBtn-container"></div>
                        </div>
                        <div class="cardDetails">
                            <span style="text-align: left;">Open</span>
                            <ul>
                                <li>From: <b><span class="open_time"></span></b></li>
                                <li>To: <b><span class="close_time"></span></b></li>
                            </ul>
                            <p>
                                Contact: 0<span class="phoneNumber"></span>
                            </p>
                            <p>Address: <b><span class="address"></span></b></p>
                            <a href="" class="mapLocation" target="_blank">View Location in GMaps</a>
                        </div>
                        <div class="cardBtn-container">
                            <button class="cardBtn bookApptBtn"><i class="bx bxs-calendar-check bx-sm"></i> Book Appointment</button>
                        </div>

                    </div>
                </template>
            </section>
            
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
            
        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popup.js"></script>

        <script src="<?=ROOT?>/assets/js/petOwner/searchableDropdown.js"></script>
        <!-- <script>
            const docNameList = (<?= json_encode($this->activeSalonList) ?>).map(x => { return x.docName });
        </script>
        <script src="./assets/js/petOwner/searchFilters_vet.js"></script> -->

        <script defer>

            console.log("ActiveList: ", (<?= json_encode($this->activeSalonList) ?>).map(x => x.salonName));

            fetch('PO_apptDashboard_Salon/getSalons')
            .then(response => response.json())
            .then(data => console.log(data));

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
            
            fetchAndAppendCards(
                'PO_apptDashboard_Salon/getSalons',
                '.availSessCard-template',
                '.availSessCard-container'
            )
            
            document.querySelector('.apptHistoryCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails_appt(button);
                    (button.classList.contains('ratingBtn')) && displayPopUp('popup_feedback', cardDetailsObj);
                }
            })

            document.querySelector('.apptUpcomingCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails_appt(button);
                    (button.classList.contains('editBtn')) && displayPopUp('popup_editAppt', cardDetailsObj);
                    (button.classList.contains('rescheduleBtn')) && displayPopUp('popup_rescheduleAppt', cardDetailsObj);
                    (button.classList.contains('cancelBtn')) && displayPopUp('popup_cancelAppt', cardDetailsObj);
                }
            })

            function getCardDetails_session  (btn) {
                const card = btn.closest('.card');
                const cardDetails = {
                    salonID: card.getAttribute('salonID'),
                };
                return cardDetails;
            }

            // redirect to bookApt page after saving session details in SESSION[]
            document.querySelector('.availSessCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails_session(button);
                    const params = new URLSearchParams(cardDetailsObj).toString();
                    const url = `PO_apptDashboard_salon/redirectToBookAppt?${params}`;
                    window.location.href = url;
                }
            })
            
        </script>
    </body>
</html>