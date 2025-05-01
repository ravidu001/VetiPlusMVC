<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Book a Vet</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/cardStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

    </head>
    <body>
        <script> const ROOT = `<?= ROOT ?>`; </script>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">
            
            <section class="dashArea">
                <h2 class="dashHeader">Book an Appointment</h2>
                
                    <div class="card bookingCard thisSession">

                        <div class="apptDetails">
                            <img src="" alt="providerPic" class="cardPic providerPic" style="height: clamp(5em, 6vw, 6em);">
                            <span class="providerName" style="font-weight: 800;"></span>
                            <p> Specializing in <span class="doctorSpecialization"></span>
                            </p>
                            <p class="details"></p>
                            <div class="avgRating loneBtn-container"></div>
                            <span class="sessNote"></span>
                            <ul>
                                <li>From: <b><span class="sessStartDateTime"></span></b></li>
                                <li>To: <b><span class="sessEndDateTime"></span></b></li>
                            </ul>
                            <p><strong class="availApptCount"></strong> appointments available.</p>
                            <p>District: <b><span class="district"></span></b></p>
                            <a href="" class="mapLocation" target="_blank">View Location in GMaps</a>
                        </div>

                        <form action="PO_bookAppt_Vet/bookAppt" method="post" id="apptBookingForm_vet" class="apptBookingForm">

                            <div class="formGroup">
                                <label for="pet"> Pet:</label>
                                <select id="petSelect" name="petID" class="formSelect" required>
                                    <option value="">Select a pet</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="pet"> Time Slot:</label>
                                <select id="timeSlotSelect" name="visitTime" class="formSelect" required>
                                    <option value="">Select a time slot</option>
                                </select>
                            </div>
        
                            <input type="hidden" name="sessionID" class="sessionID" value="">
                            
                            <button class="submitBtn popupBtn" type="submit">Submit</button>
                            <button class="clearBtn popupBtn" type="reset">Clear</button>
        
                        </form>
                    </div>
            </section>

            <section class="dashArea">
                <h3 class="dashHeader">More sessions by this Doctor</h3>
                <div class="longCard-container availSessByThisCard-container"></div>
            </section>

            <section class="dashArea">
                <h2 class="dashHeader">Search for others</h2>

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

        
        <script src="<?=ROOT?>/assets/js/petOwner/slotsDivider.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popup.js"></script>
        <script defer>
            document.getElementById('apptBookingForm_vet').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = event.target;
                const formMethod = form.getAttribute('method');
                const formData = new FormData(form);

                fetch('PO_bookAppt_Vet/bookAppt', {
                    method: formMethod || 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data1 => {
                    console.log(data1)
                    if (!data1.success) {
                        const errorObj = {
                            popUpTitle: "Error", 
                            popUpMsg: "Something went wrong! Please try again later.",
                            popUpIcon: `${ROOT}/assets/images/petOwner/popUpIcons/fail.png`,
                            nextPage: 'PO_home'
                        }
                        displayPopUp('popup_formResult', errorObj)
                    }
                    else {
                        let apptID = data1.appointmentID;
                        let payObj = {action: 'PO_bookAppt_Vet/acceptPayment', serviceType: 'vet', amount: '300', appointmentID: apptID};
        
                        fetch('PO_bookAppt_Vet/getSavedCard')
                        .then(response => response.json())
                        .then(data2 => {
                            (data2.fetchedCount != 0) && (payObj = {...payObj, ...data2[0]});
                            console.log(payObj);
                            displayPopUp('popup_payment', payObj);
                        })
                    }
                })
            })
            
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
                'PO_bookAppt_Vet/getAvailableSessions_specific',
                '.availSessCard-template',
                '.availSessByThisCard-container'
            );
            fetchAndAppendCards(
                'PO_bookAppt_Vet/getAvailableSessions',
                '.availSessCard-template',
                '.availSessCard-container'
            );

            fetch('PO_bookAppt_Vet/getSpecificSession')
            .then(response => response.json())
            .then(data => {
                let thisSession = data;
                console.log(thisSession)
                fillDivData(thisSession, '.thisSession');

                const slots = divideTimeRangeBySlotDuration(thisSession.sessStartDateTime, thisSession.sessEndDateTime,
                                                    thisSession.slotDuration, thisSession.totApptCount);

                fetch('PO_bookAppt_Vet/getBookedSessionSlots')
                .then(response => response.json())
                .then(data => {
                    (data.fetchedCount == 0) && (data = []);

                    let bookedSlots = Array.from(data.map(x => x.visitTime.substring(0, 5)));

                    const timeSlotSelect = document.getElementById('timeSlotSelect');
                    slots.forEach(slot => {
                        const start = new Date(slot.start);
                        const end = new Date(slot.end);

                        const startTime = `${pad(start.getHours())}:${pad(start.getMinutes())}`;
                        const endTime = `${pad(end.getHours())}:${pad(end.getMinutes())}`;

                        let optionHTML = document.createElement('option');
                        optionHTML.value = `${startTime}`;
                        optionHTML.textContent = `${startTime} - ${endTime}`;
                        bookedSlots.includes(startTime) && (optionHTML.disabled = true);
                        
                        timeSlotSelect.appendChild(optionHTML);
                    })
                });
            });

            const petSelect = document.getElementById('petSelect');
            const petList = (<?= json_encode($this->petList) ?>).map(x => { return {petID: x.petID, petName: x.name} });
            petList.forEach(pet => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${pet.petID}`;
                optionHTML.textContent = `${pet.petName}`;
    
                petSelect.appendChild(optionHTML);
            });

            function getCardDetails_session  (btn) {
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