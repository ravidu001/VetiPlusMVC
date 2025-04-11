// ***************************************************************
// this JS file is only to be included in view files that have forms that need to be submitted via fetch.
// <script src="<?=ROOT?>/assets/js/petOwner/fetchHandler.js"></script>
// ***************************************************************


// Attach fetchHandler to all forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', fetchHandler);
});

/**
 * Send the form's data to its specified action function, get the response, and do accordingly
 * @param {*} event The form being submitted
 */
async function fetchHandler(event) {
    event.preventDefault(); // Prevent default form submission
    const form = event.target; // The form that was submitted

    const formAction = form.getAttribute('action');
    const formMethod = form.getAttribute('method');
    const formData = new FormData(form); // Collect form data

    try {
        const response = await fetch(formAction, {
            method: formMethod || 'POST',
            body: formData,
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const dataObject = await response.json();

        // check if php says that the form's input are invalid
        if (dataObject.status == 'inputFail') {
            const errorMsgContainer = document.querySelector('.errorMsg');
            const messages = dataObject.message.split(';');
            const ul = document.createElement('ul');
            
            messages.forEach(msg => {
                const li = document.createElement('li');
                li.textContent = msg.trim();
                ul.appendChild(li);
            });

            errorMsgContainer.innerHTML = '';
            errorMsgContainer.appendChild(ul);
            return;
        }
        
        displayPopUp(dataObject);

    } catch (error) {
        console.error('An error occurred\n' + error);
        alert('An error occurred.\nPlease try again later.\n' + error);
    }
}
