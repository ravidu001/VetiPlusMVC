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
                    formAction = 'PO_apptDashboard_Vet/cancelAppt';
                else if (btn.classList.contains('ratingBtn'))
                    formAction = 'PO_apptDashboard_Vet/postFeedback';
                
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
                    <div class="searchFilter">
                        <label for="doctorSelect">Search by doctor's name:</label>
                        <select id="doctorSelect" class="searchBar">
                            <option value="" disabled selected>Search by doctor's name.</option>
                        </select>
                    </div>
                    <div class="searchFilter">
                        <label for="districtSelect">Search by district:</label>
                        <select id="districtSelect" class="searchBar">
                            <option value="" disabled selected>Search by district.</option>
                        </select>
                    </div>
                    <div class="searchFilter">
                        <label for="dateFilter">Search by date:</label>
                        <input type="date" id="dateFilter" class="searchBar" min="<?= (new DateTime("now"))->format('Y-m-d') ?>">
                    </div>
                    <div class="searchFilter">
                        <label for="timeFilter">Search by starting time:</label>
                        <input type="time" id="timeFilter" class="searchBar">
                    </div>
                </div>

                <div class="longCard-container availSessCard-container"></div>
                <template class="availSessCard-template">
                    <div class="card sessionCard availSessCard" sessionID doctorID>
                        <div class="cardPic-container">
                            <img src="" alt="providerPic" class="cardPic providerPic">
                        </div>
                        <div class="cardDetails">
                            <p>
                                <span class="providerName" style="font-weight: 800; font-size: 1.3em;"></span>
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
                            <p><strong class="availApptCount"></strong> appointments available.</p>
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
        <script src="<?=ROOT?>/assets/js/petOwner/slotsDivider.js"></script>

        <script defer>
            const districtList = [
                "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", 
                "Galle", "Gampaha", "Hambantota", "Jaffna", "Kalutara", 
                "Kandy", "Kegalle", "Kilinochchi", "Kurunegala", "Mannar", 
                "Matale", "Matara", "Monaragala", "Mullaitivu", "Nuwara Eliya", 
                "Polonnaruwa", "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
            ];
            const districtSelect = document.getElementById('districtSelect');
            districtList.map(x => {
                let optionHTML = document.createElement('option');
                optionHTML.value = x;
                optionHTML.textContent = x;
                districtSelect.appendChild(optionHTML);
            })

            const docNameList = (<?= json_encode($this->activeDocList) ?>).map(x => x.docName);
            const doctorSelect = document.getElementById('doctorSelect');
            docNameList.map(x => {
                let optionHTML = document.createElement('option');
                optionHTML.value = x;
                optionHTML.textContent = `Dr. ${x}`;
                doctorSelect.appendChild(optionHTML);

            });
            
            document.querySelector('.searchFilter-container').addEventListener('change', () => {
                const docName = document.getElementById('doctorSelect').value;
                const district = document.getElementById('districtSelect').value;
                const selectedDate = document.getElementById('dateFilter').value;
                const startTime = document.getElementById('timeFilter').value;

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
            });


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

                    if (button.classList.contains('cancelBtn')) {
                        const cancelObj = {action: 'PO_apptDashboard_vet/cancelAppt', someID: cardDetailsObj.apptID}
                        displayPopUp('popup_cancelAppt', cancelObj)
                    };

                    
                    // if (button.classList.contains('rescheduleBtn')) {
                    //     const rescheduleData = (<?= json_encode($this->rescheduleCount) ?>);
                    //     cardDetailsObj.reschedulesAvailable = rescheduleData.rescheduleCount;
                    //     displayPopUp('popup_apptReschedule', cardDetailsObj)

                    //     const params = new URLSearchParams({ doctorID: cardDetailsObj.providerID }).toString();
                    //     const url = `PO_apptDashboard/getDoctorDates${params}`;
                    //     fetch(url)
                    //     .then(response => response.json())
                    //     .then(data => {
                    //         const dates = data;
                    //         const dateSelect = document.getElementById('dateSelect');
                    //         dates.forEach(date => {
                    //                 let optionHTML = document.createElement('option');
                    //                 optionHTML.value = `${date.sessionID}`;
                    //                 optionHTML.textContent = `${date.selectedDate}`;
                    //                 dateSelect.appendChild(optionHTML);
                    //             })

                    //         let thisSession = data;
                    //         const slots = divideTimeRangeBySlotDuration(thisSession.sessStartDateTime, thisSession.sessEndDateTime,
                    //                                             thisSession.slotDuration, thisSession.totApptCount);

                    //         fetch('PO_bookAppt_Vet/getBookedSessionSlots')
                    //         .then(response => response.json())
                    //         .then(data => {
                    //             (data.fetchedCount == 0) && (data = []);

                    //             let bookedSlots = Array.from(data.map(x => x.visitTime.substring(0, 5)));

                    //             const timeSlotSelect = document.getElementById('timeSlotSelect');
                    //             slots.forEach(slot => {
                    //                 const start = new Date(slot.start);
                    //                 const end = new Date(slot.end);

                    //                 const startTime = `${pad(start.getHours())}:${pad(start.getMinutes())}`;
                    //                 const endTime = `${pad(end.getHours())}:${pad(end.getMinutes())}`;

                    //                 let optionHTML = document.createElement('option');
                    //                 optionHTML.value = `${startTime}`;
                    //                 optionHTML.textContent = `${startTime} - ${endTime}`;
                    //                 bookedSlots.includes(startTime) && (optionHTML.disabled = true);
                                    
                    //                 timeSlotSelect.appendChild(optionHTML);
                    //                 })
                    //             });
                        
                    //     })
                        
                    // }
                }
            })

            function getCardDetails_session (btn) {
                const card = btn.closest('.card');
                const cardDetails = {
                    sessionID: card.getAttribute('sessionID'),
                    doctorID: card.getAttribute('doctorID'),
                };

                return cardDetails;
            }

            // redirect to bookApt page after saving session details in SESSION[]
            document.querySelector('.availSessCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const cardDetailsObj = getCardDetails_session(button);
                    const params = new URLSearchParams(cardDetailsObj).toString();
                    const url = `PO_apptDashboard_vet/redirectToBookAppt?${params}`;
                    window.location.href = url;
                }
            })
            
        </script>
    </body>
</html>