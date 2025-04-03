<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            .userCard-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px,1fr));
                gap: 5px;
                margin-top: 20px;
            }
            .userCard {
                border: 1px solid blue;
                padding: 5px;
            }
            .hide {
                display: none;
            }
        </style>
    </head>
    <body>
<!--         
        <p>Hello</p>
        <p><?= $this->myText ?></p>
        <p><?= $this->getText ?></p>
        <p><?= $this->oho ?></p> 
        -->

        <!-- 
        <select name="selectUser" id="selectUser">
            <option value="all">All</option>
            <option value="po">Pet Owners</option>
            <option value="doc">Vet Doctors</option>
            <option value="adm">System Admins</option>
        </select>
        <ul id="dataShower"></ul>
        -->
        <?php
            // $myStr = "Greetings from PHP"
        ?>

        <div class="searchContainer">
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
                <!-- <div class="loginCount"></div> -->
                <button loginCount="">Log the Count</button>
            </div>
        </template>

        <!-- <script defer>
            const cardTemplate = document.querySelector('.userCard-template');
            const cardContainer = document.querySelector('.userCard-container');
            const emailFilter = document.querySelector('#emailFilter');

            let users = [];

            emailFilter.addEventListener('input', (e) => {
                const searchValue = e.target.value.toLowerCase();
                users.forEach(user => {
                    console.log(user)
                    const isVisible = 
                        user.email.toLowerCase().includes(searchValue) || 
                        user.type.toLowerCase().includes(searchValue)
                    user.element.classList.toggle('hide', !isVisible);
                })
            })

            fetch('testing/getAllUsers')
            .then(result => result.json())
            .then(data => {
                users = data.map(user => {
                    const card = cardTemplate.content.cloneNode(true).children[0];

                    const email = card.querySelector('.email');
                    const type = card.querySelector('.type');
                    const loginCount = card.querySelector('.loginCount');

                    email.textContent = user.email;
                    type.textContent = user.type;
                    loginCount.textContent = user.loginCount;

                    cardContainer.append(card)

                    return {email: user.email, type: user.type, element: card}
                })
            })

        </script> -->

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script defer>
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
        </script>

        <script  defer>
            // const selectUser = document.getElementById('selectUser');
            // const dataShower = document.getElementById('dataShower');


            // selectUser.addEventListener('change', () => {
            //     const type = selectUser.value;
            //     let action;

            //     if (type == 'all')
            //         action = 'testing/getAllUsers';
            //     else if (type == 'po')
            //         action = 'testing/getPetOwners';
            //     else if (type == 'doc')
            //         action = 'testing/getVetDoctors';
            //     else if (type == 'adm')
            //         action = 'testing/getAdmins';

            //     fetch(action, {
            //         method: 'GET'
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         console.log(data);
            //         dataShower.innerHTML = data.map(x => `<li>${x.email}</li>`).join('');
            //     })
            //     .catch(error => {
            //         console.error('An error occurred:', error);
            //         alert('An error occurred. Please try again later.');
            //     });
            // });

        </script>
    </body>
</html>