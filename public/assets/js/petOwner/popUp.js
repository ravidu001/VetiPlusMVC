// ***********************************************************
// this JS file is only to be included in view files that may need to display a popup message.
// <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
// ***********************************************************

document.addEventListener('DOMContentLoaded', function() {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = './assets/css/petOwner/popup.css';
    document.head.appendChild(link);

    const popupHTML = `
        <!-- Popup -->
        <div class="popup">
            <h2 class="popUpTitle"></h2>
            <img src="" alt="popUpIcon" class="popUpIcon">
            <p class="popUpMsg"></p>
            <div class="popup-buttons">
                <button class="confirm-popup popup-button">Confirm</button>
                <button class="close-popup popup-button">Close</button>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('afterbegin', popupHTML);
});


// queryObject is a JSON object with the following properties:
// title: the title to be displayed
// message:  the message to be displayed
// icon: the path to the icon to be displayed
// nextPage: the URL to redirect to after the popup is closed
function displayPopUp(queryObject) {

    document.body.classList.add('popup-active');

    const myPopup = document.querySelector('.popup');
    myPopup.style.display = 'flex';
    myPopup.querySelector('.popUpTitle').textContent = queryObject.title;
    myPopup.querySelector('.popUpMsg').innerHTML = queryObject.message;
    myPopup.querySelector('.popUpIcon').src = queryObject.icon;

    // Trigger the float-down effect
    setTimeout(() => {
        myPopup.style.transform = 'translate(-50%, -50%)';
        myPopup.style.opacity = '1';
    }, 10);

    if (!queryObject.askConfirm) {
        document.querySelector('.confirm-popup').style.display = 'none';

        setTimeout(() => {
            myPopup.style.transform = 'translate(-50%, -100px)';
            myPopup.style.opacity = '0';
        }, 5400);

        setTimeout(() => {
            window.location.href = queryObject.nextPage;
        }, 6000);
    }

    document.querySelector('.confirm-popup').addEventListener('click', function() {
        myPopup.style.transform = 'translate(-50%, -100px)';
        myPopup.style.opacity = '0';

        setTimeout(() => {
            myPopup.style.display = 'none';
            document.body.classList.remove('popup-active');

            if (queryObject.confirmPath)
                window.location.href = queryObject.confirmPath;
            
        }, 500);
    });
    document.querySelector('.close-popup').addEventListener('click', function() {
        myPopup.style.transform = 'translate(-50%, -100px)';
        myPopup.style.opacity = '0';

        setTimeout(() => {
            myPopup.style.display = 'none';
            document.body.classList.remove('popup-active');

            if (queryObject.nextPage)
                window.location.href = queryObject.nextPage;
            
        }, 500);
    });    
}