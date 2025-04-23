document.addEventListener('DOMContentLoaded', function() {

    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = './assets/css/petOwner/popup.css';
    document.head.appendChild(link);

});

let popUpTypes = {popup_confirm: ``, popup_info:``, popup_formResult:``, popup_feedback:``, 
                popup_apptBooking:``, popup_apptCancel:``, popup_apptReschedule:``, popup_payment:``};


popUpTypes.popup_confirm = `
    <div class="popup popup_confirm">
        <h2 class="popUpTitle"></h2>
        <img src="" alt="popUpIcon" class="popUpIcon">
        <p class="popUpMsg"></p>
        <div class="popup-buttons">
            <button class="confirmBtn popupBtn">Confirm</button>
            <button class="closeBtn popupBtn">Cancel</button>
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
            <button class="closeBtn popupBtn">Close</button>
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
            
            <button class="submitBtn popupBtn" type="submit">Submit</button>
            <button class="clearBtn popupBtn" type="reset">Clear</button>

            <div class="errorMsg" style="justify-content:center;"></div>

        </form>
        <div class="popup-buttons">
            <button class="closeBtn popupBtn">Close</button>
        </div>

    </div>
`;

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

        star.addEventListener('mouseover', () => {
            highlightStars(i);
        });
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
    if (initialRating > 0) {
        highlightStars(initialRating);
    }
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

    console.log(type)
    const popup = document.querySelector(`.${type}`);
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

    const popupForm = popup.querySelector('.popupForm')
    if (popupForm) {
        popupForm.setAttribute('action', detailsObject.action);
        popupForm.addEventListener('submit', submitForm);
    }
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

    // Confirm button to proceed with form submission or action:
    popup.querySelector('.confirmBtn') &&
    popup.querySelector('.confirmBtn').addEventListener('click', function() {
        popup.style.transform = 'translate(-50%, -100px)';
        popup.style.opacity = '0';

        setTimeout(() => {
            popup.style.display = 'none';
            document.body.classList.remove('popup-active');
            
            // proceed with the submission of the form that called this:
            // if (detailsObject.form) {
            //     const form = document.querySelector(`.${detailsObject.form}`);
            //     form.submit();
            // } else {
                // Redirect to the next page if specified


            // (detailsObject.confirmPath) && (window.location.href = detailsObject.confirmPath);
            
        }, 500);
    });

    // Submit button to send data to server:
    // popup.querySelector('.submitBtn') &&
    // popup.querySelector('.submitBtn').addEventListener('click', function(event) {
    //     event.preventDefault(); // Prevent default form submission

    //     const form = popup.querySelector('.popupForm');
    //     const formData = new FormData(form);

    //     fetch(form.action, {
    //         method: 'POST',
    //         body: formData,
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log('Success:', data);
    //         popup.style.transform = 'translate(-50%, -100px)';
    //         popup.style.opacity = '0';

    //         setTimeout(() => {
    //             popup.style.display = 'none';
    //             document.body.classList.remove('popup-active');
    //         }, 500);
    //     })
    //     .catch((error) => {
    //         console.error('Error:', error);
    //     });
    // });


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
        }, 500);
    });
}

