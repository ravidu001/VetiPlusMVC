<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Adoption</title>
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

        <div class="popup popup_newAdoptionListing">
            <h2 class="popUpTitle"> Create new Adoption Listing </h2>

            <form action="PO_petAdoption/forAdoption_addNew" method="post" class="popupForm">
                <div class="formGroup">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="formTextInput" name="title" required>
                </div>
                <div class="formGroup">
                    <label for="species">Species:</label>
                    <input type="text" id="species" class="formTextInput" name="species" required>
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

                <div>
                    <label for="checkupDone">Animal had a recent checkup:  </label>
                    <input type="checkbox" id="checkupDone" ttargets="#lastCheckUpDate,#lastCheckUpTime" tmode="disable">
                </div>
                <div class="formGroup">
                    <label for="lastCheckUpDate">Last check-up date:</label>
                    <input type="date" id="lastCheckUpDate" class="formTextInput" name="lastCheckUpDate" disabled>
                </div>
                <div class="formGroup">
                    <label for="lastCheckUpTime">Last check-up time:</label>
                    <input type="time" id="lastCheckUpTime" class="formTextInput" name="lastCheckUpTime" disabled>
                </div>
                
                <div class="errorMsg" style="justify-content:center;"></div>

                <div>
                    <button class="submitBtn popupBtn" type="submit">Submit</button>
                    <button class="clearBtn popupBtn" type="reset">Clear</button>

                    <button class="closeBtn popupBtn" type="button">Close</button>
                </div>

            </form>
        </div>

        <div class="popup popup_editAdoptionListing">
            <h2 class="popUpTitle"> Edit Adoption Listing </h2>

            <form action="PO_petAdoption/forAdoption_edit" method="post" enctype="multipart/form-data" class="popupForm">
                <div class="formGroup">
                    <label for="adoptionImage">Image:</label>
                    <input type="file" id="adoptionImage" name="adoptionImage" accept="image/*">
                </div>

                <div class="formGroup">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="title formTextInput" name="title" required>
                </div>
                <div class="formGroup">
                    <label for="species">Species:</label>
                    <input type="text" id="species" class="species formTextInput" name="species" required>
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
                    <input type="text" id="price" class="price formTextInput" name="price" required>
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

                <div>
                    <label for="checkupDone">Animal had a recent checkup:  </label>
                    <input type="checkbox" id="checkupDone" ttargets="#lastCheckUpDate,#lastCheckUpTime" tmode="disable">
                </div>
                <div class="formGroup">
                    <label for="lastCheckUpDate">Last check-up date:</label>
                    <input type="date" id="lastCheckUpDate" class="lastCheckUpDate formTextInput" name="lastCheckUpDate" value="" disabled>
                </div>
                <div class="formGroup">
                    <label for="lastCheckUpTime">Last check-up time:</label>
                    <input type="time" id="lastCheckUpTime" class="lastCheckUpTime formTextInput" name="lastCheckUpTime" value="" disabled>
                </div>
                
                <input type="text" class="adoptionListID formTextInput" name="adoptionListID" hidden>

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
                    <div class="card longCard myListingCard" adoptionListID>
                        <div class="cardPic-container">
                            <img src="" alt="adoptionImage" class="cardPic adoptionImage">
                        </div>
                        <div class="cardDetails">
                            <h3 class="title"></h3>
                            <span class="species"></span>
                            <p>
                                <span class="freeOrSell"></span>
                                <span class="price"></span>
                            </p>
                            <span class="district"></span>
                            <span class="contactNumber"></span>
                            <p>
                                Last Checkup on: <b><span class="lastCheckUpDate"></span></b>
                            </p>
                        </div>
                        <div class="cardBtn-container">
                            <button class="cardBtn editBtn"><i class="bx bxs-edit bx-sm"></i> Edit</button>
                            <button class="cardBtn delistBtn"><i class="bx bxs-trash bx-sm"></i> Remove</button>
                        </div>
                    </div>
                </template>

            </section>

            <section class="dashArea">
                <h3 class="dashHeader">Available for Adoption</h3>

                <!-- <div class="filters">
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
                </div> -->

                <div class="longcard-container adoptionCard-container"></div>
                <template class="adoptionCard-template">
                    <div class="card longCard adoptionCard"=>
                        <div class="cardPic-container">
                            <img src="" alt="adoptionImage" class="cardPic adoptionImage">
                        </div>
                        <div class="cardDetails">
                            <h3 class="title"></h3>
                            <p>
                                <span class="freeOrSell"></span>
                                <span class="price"></span>
                            </p>
                            <span class="district"></span>
                            <span class="contactNumber"></span>
                            <p>
                                Last Checkup Date: <b><span class="lastCheckUpDate"></span></b>
                            </p>
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
            fetchAndAppendCards(
                'PO_petAdoption/forAdoption_getMyList',
                '.myListingCard-template',
                '.myListingCard-container'
            );
            fetchAndAppendCards(
                'PO_petAdoption/forAdoption_getList',
                '.adoptionCard-template',
                '.adoptionCard-container'
            );

            const poDetails = (<?= json_encode($this->petOwnerDetails) ?>);
            document.querySelector('.addNewListing').addEventListener('click',
                () => displayPopUp('popup_newAdoptionListing', poDetails)
            )

            function getCardDetails_listing (btn) {
                const card = btn.closest('.card');

                const dateTimeDetail = card.querySelector('.lastCheckUpDate').textContent;
                const [date, time] = dateTimeDetail.split(', ');
                const formattedDate = date.split('/').reverse().join('-');
                // const [hours, minutes] = time.split(/[: ]/);
                // const formattedTime = time.includes('pm') && hours !== '12' 
                //     ? `${parseInt(hours, 10) + 12}:${minutes}` 
                //     : time.includes('am') && hours === '12' 
                //         ? `00:${minutes}` 
                //         : `${hours}:${minutes}`;
                console.log(formattedDate, time);

                const cardDetails = {
                    adoptionListID : card.getAttribute('adoptionListID'),

                    title: card.querySelector('.title').textContent,
                    species: card.querySelector('.species').textContent,

                    freeOrSell: card.querySelector('.freeOrSell').textContent,
                    price: card.querySelector('.price').textContent,

                    district: card.querySelector('.district').textContent,
                    contactNumber: card.querySelector('.contactNumber').textContent,

                    lastCheckUpDate: formattedDate,
                    lastCheckUpTime: time
                };

                return cardDetails;
            }
            document.querySelector('.myListingCard-container').addEventListener('click', function(e) {
                const button = e.target.closest('button');
                if (button) {
                    const listingdetails = getCardDetails_listing(button);
                    (button.classList.contains('editBtn')) && displayPopUp('popup_editAdoptionListing', listingdetails);
                    (button.classList.contains('delistBtn')) && displayPopUp('popup_confirm', {someID: listingdetails.adoptionListID, action: 'PO_petAdoption/forAdoption_delist'});
                }
            })
        </script>

    </body>
</html>