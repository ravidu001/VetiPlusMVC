document.addEventListener('DOMContentLoaded', function() {

    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = './assets/css/petOwner/popup.css';
    document.head.appendChild(link);

});

let popUpTypes = {
        popup_confirm: ``, popup_info:``, popup_formResult:``, popup_feedback:``, 
        popup_apptEdit: ``, popup_apptCancel:``, popup_apptReschedule:``, popup_payment:``,
        popup_newAdoptionListing: ``, popup_editAdoptionListing: ``,
        popup_newBreedingListing: ``, popup_editBreedingListing: ``
    };
let withConditionalForms =  [
    'popup_newAdoptionListing', 'popup_editAdoptionListing',
    'popup_newBreedingListing', 'popup_editBreedingListing'
]


popUpTypes.popup_confirm = `
    <div class="popup popup_confirm">
        <h2 class="popUpTitle">Confirm</h2>
        <img src="${ROOT}/assets/images/petOwner/popUpIcons/confirm.png" alt="popUpIcon" class="popUpIcon">
        <p class="popUpMsg">Are you sure?</p>
        <form action="" method="post" class="popupForm">
            <input type="text" class="someID formTextInput" name="someID" hidden>
            <div class="popup-buttons">
                <button class="submitBtn popupBtn" type="submit">Confirm</button>
                <button class="closeBtn popupBtn" type="button">Cancel</button>
            </div>
        </form>
    </div>
`;

// to tell whether form submission was successful or not:
popUpTypes.popup_formResult = `
    <div class="popup popup_formResult">
        <h2 class="popUpTitle"></h2>
        <img src="" alt="popUpIcon" class="popUpIcon">
        <p class="popUpMsg"></p>

        <div class="popup-buttons">
            <button class="okBtn popupBtn">OK</button>
            <button class="closeBtn popupBtn" type="button">Close</button>
        </div>
    </div>
`;

// to display a appointment feedback form, only used in petProfile and apptDashboard pages (totally 3):
popUpTypes.popup_feedback = `
    <div class="popup popup_feedback">
        <h2 class="popUpTitle"> Appointment Feedback </h2>
        <div class="details apptDetails">
            <h4 class="petName"></h4>
            <span class="providerName"></span>
            <span class="reason"></span>
            <h4 class="apptDateTime"></h4>
        </div>

        <form action="" method="post" class="popupForm">
            <div class="formGroup">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" min="1" max="5" hidden>
                <div id="starContainer"></div>
            </div>
            <div class="formGroup">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" required></textarea>
            </div>

            <input type="hidden" name="type" class="type" value="">
            <input type="hidden" name="apptID" class="apptID" value="">
            <input type="hidden" name="providerID" class="providerID" value="">
            <input type="hidden" name="petOwnerID" class="petOwnerID" value="">
            
            <div class="errorMsg" style="justify-content:center;"></div>

            <div>
                <button class="submitBtn popupBtn" type="submit">Submit</button>
                <button class="clearBtn popupBtn" type="reset">Clear</button>
                <button class="closeBtn popupBtn" type="button">Close</button>
            </div>
        </form>
    </div>
`;

// to display a form to add a new forAdoption listing
popUpTypes.popup_newAdoptionListing = `
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
`;

// to display a form to add a new forBreeding listing
popUpTypes.popup_newBreedingListing = `
    <div class="popup popup_newBreedingListing">
        <h2 class="popUpTitle"> Make pet available for breeding </h2>

        <form action="PO_petBreeding/forBreeding_addNew" method="post" class="popupForm">
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
                <div class="popup-buttons"></div>
                <button class="closeBtn popupBtn" type="button">Close</button>
            </div>

        </form>
    </div>
`;

popUpTypes.popup_editAdoptionListing = `
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
                <div class="popup-buttons"></div>
                <button class="closeBtn popupBtn" type="button">Close</button>
            </div>

        </form>
    </div>
`;

popUpTypes.popup_apptEdit = ``;
popUpTypes.popup_apptCancel = ``;
popUpTypes.popup_apptReschedule = ``;
popUpTypes.popup_payment = ``;

// eg: interactiveStarRating('stars', 0); for feedbback form
function interactiveStarRating(containerId, initialRating = 0) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        star.className = 'bx bx-star';
        star.dataset.value = i;

        star.addEventListener('click', () => {
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
    (initialRating > 0) && highlightStars(initialRating);
    return container.outerHTML;
}

function displayPopUp (type, detailsObject) {

    // if a popup already exists, close it:
    const existingPopup = document.querySelector('.popup');
    if (existingPopup) {
        console.log('Closing existing popup...');
        setTimeout(() => {
            existingPopup.style.transform = 'translate(-50%, -100px)';
            existingPopup.style.opacity = '0';
            existingPopup.remove();
        }, 10);
    }
    // check if type is one of the properties of popuptypes:
    if (!Object.keys(popUpTypes).includes(type)) {
        console.error('Invalid popUp type:', type);
        return;
    }
    let popupHTML = popUpTypes[type];

    (!document.body.classList.contains('popup-active')) && (document.body.classList.add('popup-active'));
    document.body.insertAdjacentHTML('afterbegin', popupHTML);

    const popup = document.querySelector(`.${type}`);
    if(!popup) console.log("NO popup");
    popup.style.display = 'flex';

    setTimeout(() => {
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.opacity = '1';
    }, 10);
    
    for (const [key, value] of Object.entries(detailsObject)) {
        const element = popup.querySelector(`.${key}`);
        if (element) {
            if (element.tagName === 'INPUT') {
                element.value = value;
            } else if (element.tagName === 'IMG') {
                element.src = value;
            } else {
                element.textContent = value;
            }
        }
    }

    if (withConditionalForms.includes(type)) {
        // for condition checkboxes:
        const togglers = document.querySelectorAll('[ttargets]');
        togglers.forEach(function (toggler) {
            const targets = toggler.getAttribute('ttargets').split(',');
            const mode = toggler.getAttribute('tmode') || 'disable';
    
            function toggleFields() {
                targets.forEach(function (selector) {
                    document.querySelectorAll(selector).forEach(function (target) {
                        switch (mode) {
                            case 'disable':
                                target.disabled = !toggler.checked;
                                break;
                            case 'readonly':
                                target.readOnly = toggler.checked;
                                break;
                            case 'opacity':
                                target.style.opacity = toggler.checked ? '1' : '0';
                                break;
                            case 'display':
                                target.style.display = toggler.checked ? '' : 'none';
                                break;
                            default:
                                target.disabled = !toggler.checked;
                        }
                    });
                });
            }
            toggleFields();
            toggler.addEventListener('change', toggleFields);
        });

        // for radio button
        const freeYes = document.getElementById('freeYes');
        const freeNo = document.getElementById('freeNo');
        const priceGrp = document.querySelector('.priceGrp');
        function togglePriceGroup() {
            if (freeYes.checked) {
                priceGrp.style.opacity = '0';
            } else if (freeNo.checked) {
                priceGrp.style.opacity = '1';
            }
        }
        togglePriceGroup();
        freeYes.addEventListener('change', togglePriceGroup);
        freeNo.addEventListener('change', togglePriceGroup);
    }

    const popupForm = popup.querySelector('.popupForm')
    if (popupForm) {
        (popupForm.getAttribute('action').trim() === '') && popupForm.setAttribute('action', detailsObject.action);
        popupForm.addEventListener('submit', submitForm);
    }
    // popupForm.querySelector('.submitBtn').addEventListener('click', submitForm);
    (type == 'popup_feedback') && interactiveStarRating('starContainer');

    // Close popup_success and popup_fail type popups automatically and refresh or go to nextPage:
    if (type == 'popup_success' || type == 'popup_fail') {
        setTimeout(() => {
            popup.style.transform = 'translate(-50%, -100px)';
            popup.style.opacity = '0';
        }, 5400);

        setTimeout(() => {
            popup.style.display = 'none';
            document.body.classList.remove('popup-active');
            if (detailsObject.nextPage) window.location.href = detailsObject.nextPage;
        }, 6000);
    }

    // OK button to proceed to next page
    popup.querySelector('.okBtn') &&
    popup.querySelector('.okBtn').addEventListener('click', function() {
        popup.style.transform = 'translate(-50%, -100px)';
        popup.style.opacity = '0';

        setTimeout(() => {
            popup.style.display = 'none';
            document.body.classList.remove('popup-active');

            (detailsObject.nextPage) && (window.location.href = detailsObject.nextPage);
            
        }, 500);
    });
    
    // Close button to close the popup or cancel submission
    popup.querySelector('.closeBtn') &&
    popup.querySelector('.closeBtn').addEventListener('click', function() {
        popup.style.transform = 'translate(-50%, -100px)';
        popup.style.opacity = '0';

        setTimeout(() => {
            popup.style.display = 'none';
            document.body.classList.remove('popup-active');
            popup.remove();
        }, 500);
    });
}

