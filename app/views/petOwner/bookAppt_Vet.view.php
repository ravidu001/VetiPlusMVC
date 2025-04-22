<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Book a Vet</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

    </head>
    <body>

        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">
            
            <section class="dashArea">
                <h2 class="dashHeader">Book a Vet Appointment</h2>

                

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

        
        <script>
            function pad(num) {
                return num.toString().padStart(2, '0');
            }

            function formatDate(date) {
                // Format as 'YYYY-MM-DD HH:mm:00'
                return `${date.getFullYear()}-${pad(date.getMonth()+1)}-${pad(date.getDate())} ${pad(date.getHours())}:${pad(date.getMinutes())}:00`;
            }
            const miDate = '2025-05-11 14:00:00'
            console.log(formatDate(new Date(miDate)))

            function divideTimeRangeBySlotDuration(start, end, slotDurationMin, apptCount) {
                const startDateTime = new Date(start.replace(' ', 'T'));
                const endDateTime = new Date(end.replace(' ', 'T'));
                const slots = [];

                let current = new Date(startDateTime);
                let slotsCreated = 0;

                while (current < endDateTime) {
                    if (slotsCreated >= apptCount) break;

                    const slotStart = new Date(current);
                    const slotEnd = new Date(current.getTime() + slotDurationMin * 60000);

                    if (slotEnd > endDateTime) break;

                    slots.push({
                        start: formatDate(slotStart),
                        end: formatDate(slotEnd)
                    });
                    slotsCreated++;
                    current = slotEnd;
                }

                return slots;
            }

            // Example usage:
            const sessStartDateTime = "2025-05-11 14:00:00";
            const sessEndDateTime = "2025-05-11 16:05:00";
            const slotDurationMin = 30; // 30 minutes per slot

            const slots = divideTimeRangeBySlotDuration(sessStartDateTime, sessEndDateTime, slotDurationMin, 3);
            console.log(slots);

        </script>
        
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

    </body>
</html>