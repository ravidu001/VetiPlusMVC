<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Vet Appointments</title>
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
                        Search by a doctor's name:
                        <input type="text" name="docName" class="searchBar" placeholder="Search by a doctor's Name.">
                        <ul class="dropdownList"></ul>
                    </div>
                    
                    <div class="filter-group" id="districtFilter">
                        Search by district:
                        <input type="text" name="district" class="searchBar" placeholder="Search by district.">
                        <ul class="dropdownList"></ul>
                    </div>

                    <div class="filter-group" id="dateFilter">
                        Search available sessions by date:
                        <input type="date" name="date" class="searchBar" min="<?= (new DateTime("now"))->format('Y-m-d') ?>">
                    </div>

                    <div class="filter-group" id="timeFilter">
                        Search available sessions by starting time:
                        <input type="time" name="time" class="searchBar" >
                    </div>

                    <button class="cardBtn clearBtn"><i class="bx bxs-clear bx-sm"></i>Clear</button>
                </div>

                <div class="longCard-container availSessCard-container"></div>
                <template class="availSessCard-template">
                    <div class="card sessionCard availSessCard" sessionID doctorID sessDate availableAppts slotDuration>
                        <div class="cardPic-container">
                            <img src="" alt="providerPic" class="cardPic providerPic">
                        </div>
                        <div class="cardDetails">
                            <p>
                                <span class="providerName" style="font-weight: 800;"></span>
                                Specializing in <span class="doctorSpecialization"></span>
                            </p>
                            <p class="details"></p>
                            <div class="avgRating loneBtn-container"></div>
                        </div>
                        <div class="cardDetails">
                            <span class="sessNote"></span>
                            <ul>
                                <li>From: <b><span class="sessStartDateTime"></span></b></li>
                                <li>To: <b><span class="sessEndDateTime"></span></b></li>
                            </ul>
                            <p><span class="availApptCount" style="font-weight: 600;"></span> appointments available.</p>
                            <p>District: <b><span class="district"></span></b></p>
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
        <script>
            const docNameList = (<?= json_encode($this->activeDocList) ?>).map(x => { return x.docName });
            const docNameFilterContainer = document.getElementById('docNameFilter');
            const docNameInput = docNameFilterContainer.querySelector('input');

            const docNameFilter = new SearchableDropdown({
                inputElement: docNameInput,
                listElement: docNameFilterContainer.querySelector('ul'),
                items: docNameList
            });

            const districtList = [
                "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", 
                "Galle", "Gampaha", "Hambantota", "Jaffna", "Kalutara", 
                "Kandy", "Kegalle", "Kilinochchi", "Kurunegala", "Mannar", 
                "Matale", "Matara", "Monaragala", "Mullaitivu", "Nuwara Eliya", 
                "Polonnaruwa", "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
            ];
            const districtFilterContainer = document.getElementById('districtFilter');
            const districtInput = districtFilterContainer.querySelector('input');
            const districtFilter = new SearchableDropdown({
                inputElement: districtInput,
                listElement: districtFilterContainer.querySelector('ul'),
                items: districtList
            });

            const dateFilterContainer = document.getElementById('dateFilter');
            const dateInput = dateFilterContainer.querySelector('input');

            const timeFilterContainer = document.getElementById('timeFilter');
            const timeInput = timeFilterContainer.querySelector('input');

            let debounceTimeout;
            function handleSearchInputs () {
                clearTimeout(debounceTimeout);

                debounceTimeout = setTimeout(() => {
                    const docName = docNameInput.value.trim();
                    const district = districtInput.value.trim();
                    const selectedDate = dateInput.value;
                    const startTime = timeInput.value;

                    const params = new URLSearchParams();

                    if (docName) params.append('docName', docName);
                    if (district) params.append('district', district);
                    if (selectedDate) params.append('selectedDate', selectedDate);
                    if (startTime) params.append('startTime', startTime);

                    const url = `PO_apptDashboard_Vet/getAvailableSessions?${params.toString()}`;

                    fetchAndAppendCards(
                        url,
                        '.availSessCard-template',
                        '.availSessCard-container'
                    )
                }, 300);
            }
            document.querySelector('.searchFilter-container').addEventListener('input', handleSearchInputs)
            document.querySelector('.searchFilter-container').addEventListener('change', handleSearchInputs)
        </script>

        <script defer>
            fetchAndAppendCards(
                'PO_apptDashboard_Vet/getAppts_upcoming',
                '.apptUpcomingCard-template',
                '.apptUpcomingCard-container'
            )

            fetchAndAppendCards(
                'PO_apptDashboard_Vet/getAppts_history',
                '.apptHistoryCard-template',
                '.apptHistoryCard-container'
            )
            
            fetchAndAppendCards(
                'PO_apptDashboard_Vet/getAvailableSessions',
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
                    type: 'vet',
                    sessionID: card.getAttribute('sessionID'),
                    doctorID: card.getAttribute('doctorID'),
                    // sessDate: card.getAttribute('sessDate'),
                    // availableAppts: card.getAttribute('availableAppts'),
                    // slotDuration: card.getAttribute('slotDuration'),

                    // providerPic: card.querySelector('.providerPic').getAttribute('src'),

                    // providerName: card.querySelector('.providerName').textContent,
                    // details: card.querySelector('.details').textContent,
                    // avgRating: card.querySelector('.avgRating'),
                    // sessStartDateTime: card.querySelector('.sessStartDateTime').textContent,
                    // sessEndDateTime: card.querySelector('.sessEndDateTime').textContent,
                    // district: card.querySelector('.district').textContent,
                };

                return cardDetails;
            }
            document.querySelector('.availSessCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails_session(button);
                    const params = new URLSearchParams(cardDetailsObj).toString();
                    const url = `PO_bookAppt_Vet?${params}`;

                    window.location.href = url;
                }
            })
            
        </script>
    </body>
</html>