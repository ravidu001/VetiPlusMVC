function showPopup(response) {
    const popup = document.getElementById('popup');
    const popupMessage = document.getElementById('popupMessage');
    const popupButton = document.getElementById('popupButton');

    if (response.status === 'Success') {
        popupMessage.innerText = `Success: ${response.msg}`;
        popupButton.innerText = 'Next';
        setTimeout(() => {
            window.location.href = response.next;
        }, 10000);
    } else {
        popupMessage.innerText = `Failure: ${response.msg}`;
        popupButton.innerText = 'Back';
        setTimeout(() => {
            window.history.back();
        }, 10000);
    }

    popupButton.onclick = () => {
        if (response.status === 'Success') {
            window.location.href = response.next;
        } else {
            window.history.back();
        }
    };

    popup.style.display = 'block';
    document.body.classList.add('blur-background');
}

// Example usage:
// showPopup({ status: 'Success', msg: 'Operation completed successfully', next: '/nextPage' });
// showPopup({ status: 'Failure', msg: 'Operation failed', next: '/retryPage' });

<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popupMessage"></p>
        <button id="popupButton"></button>
    </div>
</div>

/* CSS for the popup and blurred background */
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    z-index: 1001;
}

.popup-content {
    text-align: center;
}

#popupButton {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

#popupButton:hover {
    background-color: #0056b3;
}

.blur-background {
    filter: blur(5px);
    transition: filter 0.3s;
}