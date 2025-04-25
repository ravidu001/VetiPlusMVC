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
        <script>
            const ROOT = `<?= ROOT ?>`;
            console.log("SessionID: ", <?= json_encode($this->sessionID) ?>)
            console.log("DoctorID: ", <?= json_encode($this->doctorID) ?>)
        </script>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">
            
            <section class="dashArea">
                <h2 class="dashHeader">Book an Appointment</h2>
                
                <!-- sessionID doctorID sessDate availableAppts slotDuration -->
                    <div class="card thisSession">
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

                        <form action="PO_bookAppt_Vet/bookAppt" method="post" class="apptBookingForm">

                            <div class="formGroup">
                                <label for="pet"> Pet:</label>
                                <select id="petSelect" name="petID" required>
                                    <option value="">Select a pet</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="pet"> Time Slot:</label>
                                <select id="timeSlotSelect" name="visitTime" required>
                                    <option value="">Select a time slot</option>
                                </select>
                            </div>
        
                            <input type="hidden" name="sessionID" class="sessionID" value="">
                            <!-- <input type="hidden" name="petOwnerID" class="petOwnerID" value=<?= $this->petOwnerID ?>> -->
                            
                            <button class="submitBtn popupBtn" type="submit">Submit</button>
                            <button class="clearBtn popupBtn" type="reset">Clear</button>
        
                        </form>
                    </div>

                

            </section>

            
            <section class="dashArea">
                <h3 class="dashHeader">More sessions by this Doctor</h3>
            </section>

            <section class="dashArea">
                <h2 class="dashHeader">Search for others</h2>

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

        <script src="<?=ROOT?>/assets/js/petOwner/searchableDropdown.js"></script>

        <script>
            fetchAndAppendCards(
                'PO_apptDashboard_Vet/getAvailableSessions',
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
                    (data.fetchedCount == 0) && (data = {});

                    let bookedSlots = Array.from(data);
                    console.log(bookedSlots)

                    const timeSlotSelect = document.getElementById('timeSlotSelect');
                    slots.forEach(slot => {
                        const start = new Date(slot.start);
                        const end = new Date(slot.end);

                        const startTime = `${pad(start.getHours())}:${pad(start.getMinutes())}`;
                        const endTime = `${pad(end.getHours())}:${pad(end.getMinutes())}`;
                        // console.log(startTime);
                        // console.log(endTime);

                        let optionHTML = document.createElement('option');
                        optionHTML.value = `${startTime}`;
                        optionHTML.textContent = `${startTime} - ${endTime}`;
                        bookedSlots.includes(startTime) && optionHTML.classList.add('greyedOption');
                        
                        timeSlotSelect.appendChild(optionHTML);
                    })
                });
            });

            const petList = (<?= json_encode($this->petList) ?>).map(x => { return {petID: x.petID, petName: x.name} });
            // console.log(petList);
            const petSelect = document.getElementById('petSelect');
            petList.forEach(pet => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${pet.petID}`;
                optionHTML.textContent = `${pet.petName}`;
    
                petSelect.appendChild(optionHTML);
            });

            const docNameList = (<?= json_encode($this->activeDocList) ?>).map(x => { return x.docName });
        </script>
        <script src="<?=ROOT?>/assets/js/petOwner/searchFilters_vet.js"></script>

    </body>
</html>