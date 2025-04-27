document.addEventListener('DOMContentLoaded', function() {

    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = './assets/css/petOwner/popup.css';
    document.head.appendChild(link);

});

let popUpTypes = {
        popup_confirm: ``, popup_info:``, popup_formResult:``, popup_feedback:``, 
        popup_apptCancel:``, popup_apptReschedule:``, popup_payment:``,
        popup_newAdoptionListing: ``, popup_editAdoptionListing: ``,
        popup_newBreedingListing: ``, popup_editBreedingListing: ``
    };

let otherServicePopups =  [
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
            <button class="closeBtn popupBtn"">Close</button>
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

popUpTypes.popup_cancelAppt = `
    <div class="popup popup_cancelAppt">
        <h2 class="popUpTitle">Cancel Appointment</h2>
        <img src="${ROOT}/assets/images/petOwner/popUpIcons/confirm.png" alt="popUpIcon" class="popUpIcon">
        <p class="popUpMsg">Are you sure?</p>
        <form action="" method="post" class="popupForm">
            <input type="text" class="someID formTextInput" value="" name="someID" hidden>
            <div class="popup-buttons">
                <button class="submitBtn popupBtn" type="submit">Confirm</button>
                <button class="closeBtn popupBtn" type="button">Cancel</button>
            </div>
        </form>
    </div>
`;
popUpTypes.popup_apptReschedule = `
    <div class="popup popup_apptReschedule">
        <h2 class="popUpTitle"> Appointment Reschedule </h2>

        <div class="details apptDetails cancellingDeatails">
            <h4 class="petName"></h4>
            <span class="providerName"></span>
            <span class="reason service"></span>
            <h4 class="apptDateTime"></h4>
        </div>

        <p>You can reschedule your appointment to another session by the same Service provider.</p>
        <p> <strong class="reschedulesAvailable"></strong> free reschedules available this month.</p>

        <form action="" method="post" class="popupForm">
            <div class="formGroup">
                <label for="dateSelect">Session date:</label>
                <select id="dateSelect" name="dateSelect" class="formSelect" required>
                    <option value="" disabled selected>Select a date</option>
                </select>
            </div>
            <div class="formGroup">
                <label for="slotSelect">Time Slot:</label>
                <select id="slotSelect" name="slotSelect" class="formSelect" required>
                    <option value="" disabled selected>Select a time slot</option>
                </select>
            </div>

            <input type="text" name="type" class="type" value="" hidden>
            <input type="text" name="petID" class="petID" value="" hidden>
            <input type="text" name="cancellingApptID" class="cancellingApptID" value="" hidden>
            <input type="text" name="providerID" class="providerID" value="" hidden>
            <input type="text" name="petOwnerID" class="petOwnerID" value="" hidden>
            
            <div class="errorMsg" style="justify-content:center;"></div>

            <div>
                <button class="submitBtn popupBtn" type="submit">Submit</button>
                <button class="clearBtn popupBtn" type="reset">Clear</button>
                <button class="closeBtn popupBtn" type="button">Close</button>
            </div>
        </form>
    </div>
`;
popUpTypes.popup_payment = `
    <div class="popup popup_payment">
        <h2 class="popUpTitle"> Payment for Booking Appointment </h2>

        <form action="" method="post" class="popupForm">

            <div class="formGroup">
                <label for="serviceType">Purpose:</label>
                <input type="text" id="serviceType" class="serviceType formTextInput" name="serviceType" value="" readonly required>
            </div>
            <div class="formGroup">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" class="amount formTextInput" name="amount" value="300" readonly required>
            </div>
            <div class="formGroup">
                <label for="cardType"> Card type: </label>
                <select name="cardType" class="cardType formSelect" required>
                    <option value="" disabled selected> Select a card type </option>
                    <option value="visa"> Visa </option>
                    <option value="master"> Master </option>
                </select>
            </div>
            <div class="formGroup">
                <label for="cardNumber">Card Number:</label>
                <input type="password" id="cardNumber" class="cardNumber formTextInput" name="cardNumber" required>
            </div>
            <div class="formGroup">
                <label for="expiry">Expiry:</label>
                <input type="month" id="expiry" class="expiry formTextInput" name="expiry" required>
            </div>
            <div class="formGroup">
                <label for="CVV">CVV:</label>
                <input type="text" id="CVV" class="formTextInput" name="CVV" min="3" max="3" placeholder="e.g: XXX" required>
            </div>

            <input type="text" name="appointmentID" class="appointmentID"  hidden>
            <input type="text" name="paymentInfoID" class="paymentInfoID"  hidden>
            
            <div class="errorMsg" style="justify-content:center;"></div>

            <div>
                <button class="submitBtn popupBtn" type="submit">Submit</button>
                <button class="clearBtn popupBtn" type="reset">Clear</button>
                <button class="closeBtn popupBtn" type="button">Close</button>
            </div>

        </form>
    </div>
`;

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
        }, 10);
    }
    // check if type is one of the properties of popuptypes:
    if (!Object.keys(popUpTypes).includes(type)) {
        console.error('Invalid popUp type:', type);
        return;
    }
    let popupHTML = popUpTypes[type];

    (!document.body.classList.contains('popup-active')) && (document.body.classList.add('popup-active'));
    (!otherServicePopups.includes(type)) && (document.body.insertAdjacentHTML('afterbegin', popupHTML));

    const popup = document.querySelector(`.${type}`);
    if(!popup) console.log("NO popup");
    popup.style.display = 'flex';

    setTimeout(() => {
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.opacity = '1';
    }, 10);
    
    console.log(detailsObject);
    for (const [key, value] of Object.entries(detailsObject)) {
        const element = popup.querySelector(`.${key}`);
        if (element) {
            if (element.tagName === 'INPUT') {
                element.value = value;
            } else if (element.tagName === 'IMG') {
                element.src = value;
            } else if (element.tagName === 'SELECT') {
                const option = element.querySelector(`option[value="${value}"]`);
                (option) && (option.selected = true);
            } else {
                element.textContent = value;
            }
        }
    }

    if (otherServicePopups.includes(type)) {
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

    (type == 'popup_feedback') && interactiveStarRating('starContainer');

    // Close popup_success and popup_fail type popups automatically and refresh or go to nextPage:
    if (type == 'popup_formResult') {
        setTimeout(() => {
            popup.style.transform = 'translate(-50%, -100px)';
            popup.style.opacity = '0';
        }, 2500);

        setTimeout(() => {
            popup.style.display = 'none';
            document.body.classList.remove('popup-active');
            if (detailsObject.nextPage) window.location.href = detailsObject.nextPage;
        }, 3000);
    }

    // OK button to proceed to next page
    // popup.querySelectorAll('.okBtn') &&
    popup.querySelectorAll('.okBtn').forEach(x => {
        x.addEventListener('click', function() {
            popup.style.transform = 'translate(-50%, -100px)';
            popup.style.opacity = '0';

            setTimeout(() => {
                popup.style.display = 'none';
                document.body.classList.remove('popup-active');
                (detailsObject.nextPage) && (window.location.href = detailsObject.nextPage);
            }, 500);
        });
    })
    
    // Close button to close the popup or cancel submission
    // popup.querySelectorAll('.closeBtn') &&
    popup.querySelectorAll('.closeBtn').forEach(x => {
        x.addEventListener('click', function() {
            popup.style.transform = 'translate(-50%, -100px)';
            popup.style.opacity = '0';

            setTimeout(() => {
                popup.style.display = 'none';
                document.body.classList.remove('popup-active');
                (!otherServicePopups.includes(type)) && popup.remove();
            }, 500);
        });
    })
}

