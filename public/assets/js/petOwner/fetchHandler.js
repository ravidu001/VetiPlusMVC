// ***************************************************************
// this JS file is only to be included in view files that have forms that need to be submitted via fetch API.
// ***************************************************************


// Attach fetchHandler to all forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', fetchHandler);
});

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

        if (!response.ok) {
            throw new Error(`HTTP Error: ${response.status}`);
        }

        // const data = await response.text();
        // console.log(JSON.parse(data));

        const data = await response.json();
        displayPopUp(data);

    } catch (error) {
        console.error('An error occurred\n' + error);
        alert('An error occurred.\nPlease try again later.\n' + error);
    }
}
