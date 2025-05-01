<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Book a Salon</title>
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
                
                    <div class="card bookingCard thisSession thisSalon">

                        <div class="apptDetails">
                            <img src="" alt="providerPic" class="cardPic providerPic" style="height: clamp(5em, 6vw, 6em);">
                            <span class="name" style="font-weight: 800;"></span>
                            <p class="details"></p>
                            <div class="avgRating loneBtn-container"></div>
                            <span class="sessNote"></span>
                            <p>Phone number: <strong class="phoneNumber"></strong></p>
                            <p>Address: <b><span class="address"></span></b></p>
                            <a href="" class="mapLocation" target="_blank">View Location in GMaps</a>

                            <ul class="services"></ul>
                        </div>

                        <form action="PO_bookAppt_Salon/bookApt" method="post" id="apptBookingForm_salon">

                            <div class="formGroup">
                                <label for="petSelect">Pet:</label>
                                <select id="petSelect" name="petID" class="formSelect" required>
                                    <option value="" disabled selected>Select a pet</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="dateSelect">Date:</label>
                                <select id="dateSelect" class="formSelect" required>
                                    <option value="" disabled selected>Select a date</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="timeSlotSelect"> Time Slot:</label>
                                <select id="timeSlotSelect" name="salSessionID" class="formSelect" required>
                                    <option value="" disabled selected>Select a time slot</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="serviceSelect">Service:</label>
                                <select id="serviceSelect" name="service" class="formSelect" required>
                                    <option value=""disabled selected>Select a service</option>
                                </select>
                            </div>
        
                            <!-- <input type="hidden" name="salSessionID" class="salSessionID" value=""> -->
                            
                            <button class="submitBtn popupBtn" type="submit">Submit</button>
                            <button class="clearBtn popupBtn" type="reset">Clear</button>
        
                        </form>
                    </div>
            </section>

            <section class="dashArea">
                <h2 class="dashHeader">Search for others</h2>

                <div class="searchFilter-container">
                    <div class="searchFilter">
                        <label for="salonSelect">Search by salon's name:</label>
                        <select name="salonName" id="salonSelect" class="searchBar" placeholder="Search by a salon's Name."></select>
                    </div>
                    <div class="searchFilter">
                        <label for="date">Search by open day:</label>
                        <input type="date" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" id="dateSearch" class="searchBar">
                    </div>
                </div>

                <div class="longCard-container availSessCard-container"></div>
                <template class="availSessCard-template">
                    <div class="card sessionCard availSessCard" salonID>
                        <div class="cardPic-container">
                            <img src="" alt="providerPic" class="cardPic providerPic">
                        </div>
                        <div class="cardDetails">
                            <span class="name" style="font-weight: 800; font-size: 1.3em;"></span>
                            <div class="avgRating loneBtn-container"></div>
                        </div>
                        <div class="cardDetails">
                            <p>
                                Contact: <span class="phoneNumber"></span>
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

        <script defer>
            console.log(<?= json_encode($this->thisSalonDetails) ?>);
            fillDivData(<?= json_encode($this->thisSalonDetails) ?>, '.thisSalon');

            const salonNameList = (<?= json_encode($this->activeSalonList) ?>).map(x => x.salonName);
            document.getElementById('salonSelect').innerHTML = salonNameList.map(x => `<option value="${x}">${x}</option>`).join('');
            
            document.querySelector('.searchFilter-container').addEventListener('change', () => {
                const salonName = document.getElementById('salonSelect').value;
                const dateSelected = document.getElementById('dateSearch').value;

                const params = new URLSearchParams();
                if (salonName) params.append('salonName', salonName);
                if (dateSelected) params.append('dateSelected', dateSelected);

                const url = `PO_apptDashboard_Salon/getAvailableSalons?${params.toString()}`;
                fetchAndAppendCards(
                    url,
                    '.availSessCard-template',
                    '.availSessCard-container'
                )
            });

            fetchAndAppendCards(
                'PO_apptDashboard_Salon/getAvailableSalons',
                '.availSessCard-template',
                '.availSessCard-container'
            )

            const petSelect = document.getElementById('petSelect');
            const petList = (<?= json_encode($this->petList) ?>)
                .map(x => { return {petID: x.petID, petName: x.name} });
            petList.forEach(pet => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${pet.petID}`;
                optionHTML.textContent = `${pet.petName}`;
                petSelect.appendChild(optionHTML);
            });

            const dateSelect = document.getElementById('dateSelect');
            const openDateList = (<?= json_encode($this->openDateList) ?>)
                .map(x => { return {date: x.openday} });
            openDateList.forEach(x => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${x.date}`;
                optionHTML.textContent = `${x.date}`;
                dateSelect.appendChild(optionHTML);
            });

            dateSelect.addEventListener('change', () => {
                const dateSelected = dateSelect.value;
                const params = new URLSearchParams({date: dateSelected}).toString();
                const url = `PO_bookAppt_Salon/getSlots_byDate?${params}`;
                fetch(url)
                .then(response => response.json())
                .then(data => {
                    (data.fetchedCount == 0) && (data = []);

                    const sessionSlots = Array.from(data);
                    const timeSlotSelect = document.getElementById('timeSlotSelect');

                    timeSlotSelect.innerHTML = '<option value="" disabled selected>Select a time slot</option>';
                    sessionSlots.forEach(x => {
                        let optionHTML = document.createElement('option');
                        optionHTML.value = `${x.salSessionID}`;
                        optionHTML.textContent = `${x.time_slot}`;
                        timeSlotSelect.appendChild(optionHTML);
                        (x.status == 'blocked' || x.noOfAvailable == 0) && (optionHTML.disabled = true);
                    });
                })
            })
            
            const serviceSelect = document.getElementById('serviceSelect');
            const serviceList = (<?= json_encode($this->serviceList) ?>)
                .map(x => { return {serviceID: x.serviceID, serviceName: x.serviceName} });
            serviceList.forEach(x => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${x.serviceName}`;
                optionHTML.textContent = `${x.serviceName}`;
                serviceSelect.appendChild(optionHTML);
            });

            document.getElementById('apptBookingForm_salon').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = event.target;
                const formMethod = form.getAttribute('method');
                const formData = new FormData(form);

                fetch('PO_bookAppt_Salon/bookAppt', {
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
                        let payObj = {action: 'PO_bookAppt_salon/acceptPayment', serviceType: 'salon', amount: '300'};
                        // , groomingID: apptID
        
                        fetch('PO_bookAppt_Salon/getSavedCard')
                        .then(response => response.json())
                        .then(data2 => {
                            (data2.fetchedCount != 0) && (payObj = {...payObj, ...data2[0]});
                            console.log(payObj);
                            displayPopUp('popup_payment', payObj);
                        })
                    }
                })
            })
            
        </script>
    </body>
</html>