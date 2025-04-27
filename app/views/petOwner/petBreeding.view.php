<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Breeding</title>
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

        <div class="popup popup_newBreedingListing">
            <h2 class="popUpTitle"> Make pet available for breeding </h2>

            <form action="PO_petBreeding/forBreeding_addNew" method="post" class="popupForm">

                <img src="" class="petPic profilePic" style="display:none;">
                <div class="formGroup">
                    <label for="species">Pet:</label>
                    <select name="petID" id="petSelect">
                        <option value="" disabled selected>Select a pet</option>
                    </select>
                </div>

                <div class="formGroup">
                    <div> <p>Species</p>
                        <strong class="species"></strong>
                    </div>
                    <div> <p>Breed</p>
                        <strong class="breed"></strong>
                    </div>
                </div>

                <div class="formGroup">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="formTextInput" name="title" required>
                </div>

                <div class="formGroup">
                    <label for="freeOrSellRadios">Free:</label>
                    <div id="freeOrSellRadios">
                        <input type="radio" id="freeYes" name="freeOrSell" value="free" checked required>
                            <label for="freeYes">Yes</label>
                        <input type="radio" id="freeNo" name="freeOrSell" value="sell" required>
                            <label for="freeNo">No</label>
                    </div>
                </div>
                <div class="formGroup priceGrp" style="opacity: 0;">
                    <label for="price">Price (in LKR):</label>
                    <input type="text" id="price" class="formTextInput" name="price" value="0" required>
                </div>

                <div>
                    <label for="toggleEdit">Use my default details:  </label>
                    <input type="checkbox" id="toggleEdit" ttargets="#district,#contactNumber" tmode="readonly" checked>
                </div>
                <div class="formGroup">
                    <label for="district">District:</label>
                    <input type="text" id="district" class="district formTextInput" name="district" value="" readonly required>
                </div>
                <div class="formGroup">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="text" id="contactNumber" class="contactNumber formTextInput" name="contactNumber" value="" readonly min="10" max="10" required>
                </div>

                <div class="formGroup"></div>

                <div class="formGroup">
                    <label for="lastCheckUpDate">Last check-up date:</label>
                    <input type="date" id="lastCheckUpDate" class="formTextInput" name="lastCheckUpDate" readonly>
                </div>
                
                <div class="errorMsg" style="justify-content:center;"></div>

                <div>
                    <button class="submitBtn popupBtn" type="submit">Submit</button>
                    <button class="clearBtn popupBtn" type="reset">Clear</button>
                    <button class="closeBtn popupBtn" type="button">Close</button>
                </div>

            </form>
        </div>
        <div class="popup popup_editBreedingListing">
            <h2 class="popUpTitle"> Edit pet breeding listing </h2>

            <form action="PO_petBreeding/forBreeding_edit" method="post" class="popupForm">

                <img src="" class="petPic profilePic" style="display:none;">
                <div class="formGroup">
                    <div> <p>Name</p>
                        <strong class="petName"></strong>
                    </div>
                </div>

                <div class="formGroup">
                    <div> <p>Species</p>
                        <strong class="species"></strong>
                    </div>
                    <div> <p>Breed</p>
                        <strong class="breed"></strong>
                    </div>
                </div>

                <div class="formGroup">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="formTextInput" name="title" required>
                </div>

                <div class="formGroup">
                    <label for="freeOrSellRadios">Free:</label>
                    <div id="freeOrSellRadios">
                        <input type="radio" id="freeYes" name="freeOrSell" value="free" checked required>
                            <label for="freeYes">Yes</label>
                        <input type="radio" id="freeNo" name="freeOrSell" value="sell" required>
                            <label for="freeNo">No</label>
                    </div>
                </div>
                <div class="formGroup priceGrp" style="opacity: 0;">
                    <label for="price">Price (in LKR):</label>
                    <input type="text" id="price" class="formTextInput" name="price" value="0" required>
                </div>

                <div>
                    <label for="toggleEdit">Use my default details:  </label>
                    <input type="checkbox" id="toggleEdit" ttargets="#district,#contactNumber" tmode="readonly" checked>
                </div>
                <div class="formGroup">
                    <label for="district">District:</label>
                    <input type="text" id="district" class="district formTextInput" name="district" value="" readonly required>
                </div>
                <div class="formGroup">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="text" id="contactNumber" class="contactNumber formTextInput" name="contactNumber" value="" readonly min="10" max="10" required>
                </div>

                <div class="formGroup"></div>

                <input type="text" name="breedingListID" class="breedingListID" readonly hidden>
                
                <div class="errorMsg" style="justify-content:center;"></div>

                <div>
                    <button class="submitBtn popupBtn" type="submit">Submit</button>
                    <button class="clearBtn popupBtn" type="reset">Clear</button>
                    <button class="closeBtn popupBtn" type="button">Close</button>
                </div>

            </form>
        </div>


        <div class="bodyArea">

            <section class="dashArea">
                <div class="header-btn">
                    <h3 class="dashHeader">My Listings</h3>
                    <button class="addNewListing"><i class='bx bx-plus-circle bx-md'></i>
                        Create new listing</button>
                </div>
    
                <div class="longcard-container myListingCard-container"></div>
                <template class="myListingCard-template">
                    <div class="card sessionCard myListingCard" breedingListID>
                        <div class="cardPic-container">
                            <img src="" alt="petPic" class="cardPic petPic">
                        </div>
                        <div class="cardDetails">
                            <h3 class="title"></h3>
                            <h3 class="petName"></h3>
                            <p> <span class="species"></span> : 
                                <span class="breed"></span>
                            </p>
                            <p> <span class="freeOrSell"></span>
                                <span class="price"></span>
                            </p>
                            <!-- <p> Last Checkup on: <b><span class="lastCheckUpDate"></span></b> </p> -->
                        </div>
                        <div class="cardDetails">
                            <span class="district"></span>
                            <span class="contactNumber"></span>
                        </div>
                        <div class="cardBtn-container">
                            <button class="cardBtn editBtn"><i class="bx bxs-edit bx-sm"></i> Edit</button>
                            <button class="cardBtn delistBtn"><i class="bx bxs-trash bx-sm"></i> Remove</button>
                        </div>
                    </div>
                </template>
    
            </section>
    
            <section class="dashArea">
                <h3 class="dashHeader">Available for Breeding</h3>
    
                <div class="longcard-container breedingCard-container"></div>
                <template class="breedingCard-template">
                    <div class="card longCard breedingCard">
                        <div class="cardPic-container">
                            <img src="" alt="petPic" class="cardPic petPic">
                        </div>
                        <div class="cardDetails">
                            <h3 class="title"></h3>
                            <p> <span class="species"></span>
                                <span class="breed"></span>
                            </p>
                            <p> <span class="freeOrSell"></span>
                                <span class="price"></span>
                            </p>
                            <!-- <p> Last Checkup on: <b><span class="lastCheckUpDate"></span></b> </p> -->
                        </div>
                        <div class="cardDetails">
                            <span class="district"></span>
                            <span class="contactNumber"></span>
                        </div>
                    </div>
                </template>
    
            </section>
                    
            <!-- <section class="dashArea" id="myListings">
                <h2>My Listings</h2>
                <button>List new pet for Breeding</button>
                <div class="listingsList">
                    <p>No pets made available for breeding</p>
                </div>
            </section>

            <section class="dashArea">
                <h1>Pets for Breeding</h1>
                <i>Search and breed your pets in a safe and responsible manner.</i>
                <div class="filters">
                    <div class="filterSearchContainer">
                        <label for="locationFilter">Filter by Location: </label>
                        <input type="search" id="locationFilter" placeHolder="filter by Location">
                    </div>
                    <div class="filterSearchContainer">
                        <label for="speciesFilter">Filter by Species: </label>
                        <input type="search" id="speciesFilter" placeHolder="filter by Species">
                    </div>
                    <div class="filterSearchContainer">
                        <label for="breedFilter">Filter by Breed: </label>
                        <input type="search" id="breedFilter" placeHolder="filter by Breed">
                    </div>
                </div>
                <div class="searchResults">
                <?php for($i=0; $i<3; $i++): ?>
                    <div class="itemCard">
                        <img src="<?= ROOT.'/assets/images/adultDog1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Golden Retriever (Male)</h3>
                            <span>Rs.15000</span>
                            <span><b>Kandy, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0713167854</span>
                            <span><b>Last check-up:</b> 25.10.2024</span>
                        </div>
                    </div>
                    <div class="itemCard">
                        <img src="<?= ROOT.'/assets/images/adultCat1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Persian Cat (Male)</h3>
                            <span>Rs.10000</span>
                            <span><b>Dehiwela, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0713167854</span>
                            <span><b>Last check-up:</b> 10.11.2024</span>
                        </div>
                    </div>
                <?php endfor; ?>
                </div>
            </section> -->

            
            
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popup.js"></script>
        <script defer>

            const petSelect = document.getElementById('petSelect');
            const petList = (<?= json_encode($this->petList) ?>).map(x => { return {petID: x.petID, petName: x.name} });
            petList.forEach(pet => {
                let optionHTML = document.createElement('option');
                optionHTML.value = `${pet.petID}`;
                optionHTML.textContent = `${pet.petName}`;
    
                petSelect.appendChild(optionHTML);
            });

            petSelect.addEventListener('change', () => {
                const petID = petSelect.value;
                url = `PO_petBreeding/getPetDetailsToFill?petID=${petID}`;
                fetch(url)
                .then(response => response.json())
                .then(data => {
                    fillDivData(data, '.popup_newBreedingListing');
                    fillDivData(data, '.popup_editBreedingListing');
                })
            })

            fetchAndAppendCards(
                'PO_petBreeding/forBreeding_getMyList',
                '.myListingCard-template',
                '.myListingCard-container'
            );
            fetchAndAppendCards(
                'PO_petBreeding/forBreeding_getList',
                '.breedingCard-template',
                '.breedingCard-container'
            );

            const poDetails = (<?= json_encode($this->petOwnerDetails) ?>);
            document.querySelector('.addNewListing').addEventListener('click',
                () => displayPopUp('popup_newBreedingListing', poDetails)
            )

            function getCardDetails_listing (btn) {
                const card = btn.closest('.card');

                const dateTimeDetail = card.querySelector('.lastCheckUpDate').textContent;
                const [date, time] = dateTimeDetail.split(', ');
                const formattedDate = date.split('/').reverse().join('-');
                console.log(formattedDate, time);

                const cardDetails = {
                    breedingListID : card.getAttribute('breedingListID'),

                    title: card.querySelector('.title').textContent,
                    species: card.querySelector('.species').textContent,
                    petName: card.querySelector('.petName').textContent,
                    freeOrSell: card.querySelector('.freeOrSell').textContent,
                    price: card.querySelector('.price').textContent,

                    district: card.querySelector('.district').textContent,
                    contactNumber: card.querySelector('.contactNumber').textContent,
                };

                return cardDetails;
            }
            document.querySelector('.myListingCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const listingdetails = getCardDetails_listing(button);
                    (button.classList.contains('editBtn')) && displayPopUp('popup_editBreedingListing', listingdetails);
                    (button.classList.contains('delistBtn')) && displayPopUp('popup_confirm', {someID: listingdetails.breedingListID, action: 'PO_petBreeding/forBreeding_delist'});
                }
            })
        </script>

    </body>
</html>