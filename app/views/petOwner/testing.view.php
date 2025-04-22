<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            .card-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px,1fr));
                gap: 5px;
                margin-top: 20px;
            }
            .card {
                border: 1px solid blue;
                padding: 5px;
            }
            .hide {
                display: none;
            }

            #stars {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
                font-size: 24px;
            }
            .bx {
                font-size: 24px;
                color: #ffc107; /* Yellow color for stars */
                margin-right: 2px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .bx:hover {
                transform: scale(1.2);
            }

            .editableDiv {
                min-height: 3rem;
                width: 200px;
                /* border: 1px solid #ccc; */
                field-sizing: content;
                resize: none;
                font-family: 'Poppins', sans-serif;  
            }
            
            .card-float-in {
                animation: floatIn 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            }
            
            @keyframes floatIn {
                from {
                opacity: 0;
                transform: translateY(30px) scale(0.96);
                }
                to {
                opacity: 1;
                transform: translateY(0) scale(1);
                }
            }

            .dropdown {
            position: relative;
            width: 250px;
            }

            #searchInput {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        <!-- <link href="<?= ROOT ?>/assets/css/petOwner/popup.css" rel="stylesheet"> -->
        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

    </head>
    <body>
    <!--         
        <p>Hello</p>
        <p><?= $this->myText ?></p>
        <p><?= $this->getText ?></p>
        <p><?= $this->oho ?></p> 
    -->

        <!-- <div class="searchContainer">
            <label for="emailFilter">Filter by Email</label>
            <input type="search" id="emailFilter">

            <label for="typeFilter">Filter Users</label>
            <select name="typeFilter" id="typeFilter">
                <option value="">All</option>
                <option value="vet doctor">Vet Doctor</option>
                <option value="pet owner">Pet Owner</option>
                <option value="salon">Pet Salon</option>
                <option value="vet assistant">Vet Assistant</option>
                <option value="system admin">System Admin</option>
            </select>
        </div>

        <div class="userCard-container"></div>
        <template class="userCard-template">
            <div class="userCard">
                <div class="email"></div>
                <div class="type"></div>
                // <div class="loginCount"></div>
                <button loginCount="">Log the Count</button>
            </div>
        </template> -->

        <div class="dropdown">
            <input type="text" id="searchInput" placeholder="Search...">
            <ul id="dropdownList" class="dropdown-list"></ul>
        </div>

        <script>
            const items = [
                "Apple", "Banana", "Cherry", "Date", "Grapes", "Mango", "Orange", "Pineapple"
                ];
    
                const searchInput = document.getElementById("searchInput");
                const dropdownList = document.getElementById("dropdownList");
    
                function filterItems(searchText) {
                    const filteredItems = items.filter(item =>
                        item.toLowerCase().includes(searchText.toLowerCase())
                    );
                    
                    dropdownList.innerHTML = "";
                    if (filteredItems.length > 0 && searchText.length > 0) {
                        dropdownList.style.display = "block";
                        filteredItems.forEach(item => {
                            let li = document.createElement("li");
                            li.innerText = item;
                            li.onclick = () => selectItem(item);
                            dropdownList.appendChild(li);
                        });
                    } else {
                        dropdownList.style.display = "none";
                    }
                }
    
                function selectItem(value) {
                    searchInput.value = value;
                    dropdownList.style.display = "none";
                }
    
                searchInput.addEventListener("input", () => filterItems(searchInput.value));
    
                // Optional: Hide dropdown when clicking outside
                document.addEventListener("click", function(e) {
                if (!e.target.closest(".dropdown")) {
                    dropdownList.style.display = "none";
                }
                });
        </script>

        <div class="searchContainer">
            <label for="dateSearch">Search by Date</label>
                <input type="date" id="dateSearch">

            <label for="sessionTime">Filter by Time</label>
            <input type="time" id="sessionTime">

            <label for="sessionDistrict">Filter by District</label>
            <select name="sessionDistrict" id="sessionDistrict">
                <option value="">All</option>
                <option value="Ampara">Ampara</option>
                <option value="Colombo">Colombo</option>
                <option value="Kandy">Kandy</option>
            </select>

            <label for="docNameSearch">Filter by Doctor:</label>
                <input type="text" id="docNameSearch">
        </div>

        <div class="card-container sessionCard-container"></div>
        <template class="sessionCard-template">
            <div class="card sessionCard" publishedTime>
                <div class="fullName"></div>
                <div class="selectedDate"></div>
                <div class="startTime"></div>
                <div class="endTime"></div>
                <div class="district"></div>
                <div class="clinicLocation"></div>
                <button onclick="logObject()">Log this card Object!</button>
            </div>
        </template>

        <form action="">
            <div class="formGroup">
                <label for="rating">Rating</label>
                <input type="number" name="rating" value="0" id="rating" hidden>
                <div id="stars"></div>
            </div>
        </form>

        <label for="txt1">Label 1:</label>
        <div contenteditable class="editableDiv" id="txt1"> HELLO THERE </div>

        <label for="txt2">Label 2:</label>
        <textarea name="" class="editableDiv" id="txt2" placeholder="eg: HELLO THERE"> HELLO THERE </textarea>

        <input type="text class="editableDiv" value="HELLO THERE" placeholder="eg: HELLO THERE">

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <!-- <script defer>
            // Step 1: Fetch and display cards
            let userData; // Store fetched data for filtering

            fetchAndAppendCards(
                'testing/getAllUsers',
                '.userCard-template',
                '.userCard-container'
            ).then(data => {
                userData = data; // Save fetched data for filtering
            });

            // Step 2: Set up filtering
            const emailFilter = document.querySelector('#emailFilter');
            const typeFilter = document.querySelector('#typeFilter');
            
            const filters = {
                email: '',
                type: ''
            };

            // Function to update filters and apply them
            function updateFilters() {
                filters.email = emailFilter.value; // Update email filter
                filters.type = typeFilter.value; // Update type filter

                // Apply both filters
                filterCards(userData, filters, '.userCard-container');
            }

            // Add event listeners to inputs
            emailFilter.addEventListener('input', updateFilters);
            typeFilter.addEventListener('change', updateFilters);

            document.querySelector('.userCard-container').addEventListener('click', (event) => {
                // console.log(event);
                const card = event.target.closest('.userCard');
                console.log(card);
                const typeVal = card.querySelector('.type').textContent;
                console.log(typeVal)
            })

            // emailFilter.addEventListener('input', (e) => {
            //     const searchValue = e.target.value;
            //     filterCards(userData, searchValue, '.userCard-container', ['email', 'type']);
            // });

            // typeFilter.addEventListener('change', (e) => {
            //     const searchValue = e.target.value;
            //     filterCards(userData, searchValue, '.userCard-container', ['type']);
            // });


            //     const emailFilter = document.querySelector('#emailFilter');
            //     const typeFilter = document.querySelector('#typeFilter');

            //     const filters = {
            //         email: '',
            //         type: ''
            //     };

            //     const filterKeys = ['email', 'type'];

            //     function updateFiltersAndSort() {
            //         filters.email = emailFilter.value;
            //         filters.type = typeFilter.value;
            //         console.log(filters)

            //         // Determine which input was last changed and sort accordingly
            //         const lastChangedInput = document.activeElement.id;
            //         const sortBy = lastChangedInput.replace('Filter', ''); // Extract field name (e.g., 'apptDate')

            //         // Call the filter and sort function
            //         filterAndSortCards(userData, filters, '.userCard-container', filterKeys, sortBy);
            //     }

            //     // Add event listeners to inputs
            //     emailFilter.addEventListener('input', updateFiltersAndSort);
            //     typeFilter.addEventListener('input', updateFiltersAndSort);
        </script> -->

        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script>
            // const retrivedObj = {
            //     status: "success",
            //     title: "Success! 😺",
            //     message: "Registration successful!",
            //     icon: `<?= ROOT ?>/assets/images/petOwner/popUpIcons/success.png`
            // };
            // displayPopUp ('popup_formResult', retrivedObj);
            // displayPopUp ('popup_formResult', retrivedObj);
        </script>

        <script>
            function createInteractiveRating(containerId, initialRating = 0) {
                const container = document.getElementById(containerId);
                if (!container) return;
                
                container.innerHTML = '';
                
                for (let i = 1; i <= 5; i++) {
                    const star = document.createElement('i');
                    star.className = 'bx bx-star';
                    star.dataset.value = i;

                    star.addEventListener('mouseover', () => {
                        highlightStars(i);
                    });
                    star.addEventListener('click', () => {
                        // alert(`You rated ${i} stars!`);
                        document.getElementById('rating').value = i;
                        highlightStars(i);
                    });
                    
                    container.appendChild(star);
                }
                function highlightStars(count) {
                    const stars = container.querySelectorAll('i');
                    stars.forEach((star, index) => {
                        star.className = index < count ? 'bx bxs-star' : 'bx bx-star';
                    });
                }
                if (initialRating > 0) {
                    highlightStars(initialRating);
                }
            }
            createInteractiveRating('stars', 0);
        </script>

        <script>
            fetchAndAppendCards(
                `testing/getSessions`,
                '.sessionCard-template',
                '.sessionCard-container'
            ).then(data => {
                sessionData = data;
            });

            const docNameInput = document.querySelector('#docNameSearch');
            const dateInput = document.querySelector('#dateSearch');
            let debounceTimeout;

            // Shared handler for both inputs
            function handleSearchInputs() {
                clearTimeout(debounceTimeout);

                debounceTimeout = setTimeout(() => {
                    // Get current values from both inputs
                    const docName = docNameInput.value.trim();
                    const selectedDate = dateInput.value; // assuming it's a date input

                    // Build query params
                    const params = new URLSearchParams();
                    if (docName) params.append('docName', docName);
                    if (selectedDate) params.append('selectedDate', selectedDate);

                    const url = `testing/getSessions?${params.toString()}`;

                    fetchAndAppendCards(
                        url,
                        '.sessionCard-template',
                        '.sessionCard-container'
                    ).then(data => {
                        sessionData = data;
                    });
                }, 300); // 300ms debounce
            }

            // Attach the same handler to both inputs
            docNameInput.addEventListener('input', handleSearchInputs);
            dateInput.addEventListener('input', handleSearchInputs);

            // let debounceTimeout;
            // const docNameSearch = document.querySelector('#docNameSearch');
            // docNameSearch.addEventListener('input', (e) => {
            //     clearTimeout(debounceTimeout);
            //     const docName = e.target.value.trim();

            //     const params = new URLSearchParams({
            //         docName: docName,
            //         selectedDate: selectedDateValue
            //     });
            //     const url = `testing/getSessions?${params.toString()}`;

            //     debounceTimeout = setTimeout(() => {
            //         fetchAndAppendCards(
            //             url,
            //             '.sessionCard-template',
            //             '.sessionCard-container'
            //         ).then(data => {
            //             sessionData = data;
            //         });
            //     }, 300);
            // });



            // const sessionDate = document.querySelector('#sessionDate');
            // const sessionTime = document.querySelector('#sessionTime');
            // const sessionDistrict = document.querySelector('#sessionDistrict');

            // const myObj = {
            //     myDate: '2025-03-15',
            //     myTime: '13:30:00',
            //     myNum: 77,
            //     myName: 'Manuel',
            //     myTruth: true,
            //     myArray: [1, 2, 3, 4, 5],
            //     myDistrict: 'Colombo'
            // };

            // // Function to update filters and apply them
            // function updateFilters() {
            //     sessionFilters.date = sessionDate.value ? new Date(sessionDate.value) : null;
            //     sessionFilters.time = sessionTime.value ? sessionTime.value : null;
            //     sessionFilters.district = sessionDistrict.value;

            //     // sessionFilters.endDate = endDateInput.value ? new Date(endDateInput.value) : null;
            //     // Apply all filters
            //     filterCards(sessionData, sessionFilters, '.sessionCard-container');
            // }
            // // Add event listeners to inputs
            // sessionDate.addEventListener('input', updateFilters);
            // sessionTime.addEventListener('input', updateFilters);
            // sessionDistrict.addEventListener('input', updateFilters);

        </script>

    </body>
</html>