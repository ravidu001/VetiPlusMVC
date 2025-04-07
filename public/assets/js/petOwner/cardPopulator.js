// ***************************************************************
// this JS file contains only functions that have to be called in the view file to use with custom parameter
// <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
// ----------
// 0. createCard() is used within fetchAndAppendCards() itself
// ----------
// 1. fetchAndAppendCards() - the main fetch and card-container append/populator; use something like this:
// let userData; // Store fetched data for filtering
// fetchAndAppendCards(
//     'testing/getAllUsers',
//     '.userCard-template',
//     '.userCard-container'
// ).then(data => {
//     userData = data; // Save fetched data for filtering
// });
// ----------
// 2. filterCards() - if the displayed cards need to be filtered use something like this:
// const emailFilter = document.querySelector('#emailFilter');
// const typeFilter = document.querySelector('#typeFilter');
// const filters = {
//     email: '',
//     type: '',
//     startDate: null,
//     endDate: null
// };
// // Function to update filters and apply them
// function updateFilters() {
//     filters.email = emailFilter.value; // Update email filter
//     filters.type = typeFilter.value; // Update type filter
//     filters.startDate = startDateInput.value ? new Date(startDateInput.value) : null; // Update start date
//     filters.endDate = endDateInput.value ? new Date(endDateInput.value) : null; // Update end date
//     // Apply all filters
//     filterCards(userData, filters, '.userCard-container');
// }
// // Add event listeners to inputs
// emailFilter.addEventListener('input', updateFilters);
// typeFilter.addEventListener('change', updateFilters);
// startDateInput.addEventListener('change', updateFilters);
// endDateInput.addEventListener('change', updateFilters);

// ***************************************************************

/**
 * Creates a card element based on the template and data object.
 * @param {HTMLElement} template - The template element to clone.
 * @param {Object} data - The data object containing key-value pairs.
 * @returns {HTMLElement} - The created card element.
 */
function createCard(template, data) {
    const card = template.content.cloneNode(true).children[0];

    // Iterate over the data object and populate the card
    for (const [key, value] of Object.entries(data)) {
        const element = card.querySelector(`.${key}`);
        if (element) {
            // for rating data
            if (key == 'apptRating') {
                if (value == null) {
                    console.log("Null apptRating!")
                    element.innerHTML = `<button cardBtn><i class="bx bxs-star bx-md"></i> Rate Appointment</button>`;
                } else {
                    console.log(value)
                    let stars = '';
                    let i = 0;
                    for (i; i < value; i++) stars += `<i class="bx bxs-star bx-sm"></i>`;
                    for (i; i < 5; i++) stars += `<i class="bx bx-star bx-sm"></i>`;
                    element.innerHTML = stars;
                }
            }
            else element.textContent = value;
        } else {
            const button = card.querySelector('button');
            button && button.hasAttribute(key) && button.setAttribute(key, value);
        }
    }

    return card;
}

/**
 * Fetches data from a URL, creates cards, and appends them to a container.
 * @param {string} url - The URL to fetch data from.
 * @param {string} templateSelector - The selector for the card template.
 * @param {string} containerSelector - The selector for the container to append cards.
 * @returns {Promise<Array>} - A promise that resolves to the fetched data array.
 */
async function fetchAndAppendCards(url, templateSelector, containerSelector) {
    const template = document.querySelector(templateSelector);
    const container = document.querySelector(containerSelector);

    if (!template || !container) {
        console.error('Template or container not found!');
        return;
    }

    try {
        const response = await fetch(url);
        const data = await response.json();

        data.forEach(item => {
            const card = createCard(template, item);
            container.append(card);
        });

        return data; // Return the fetched data for filtering
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

/**
 * Filters cards based on multiple filter criteria and updates their visibility.
 * @param {Array} data - The array of data objects used to create the cards.
 * @param {Object} filters - An object containing filter values (e.g., { email: 'example@test.com', type: 'vet doctor', startDate: Date, endDate: Date }).
 * @param {string} containerSelector - The selector for the container holding the cards.
 */
function filterCards(data, filters, containerSelector) {
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error('Container not found!');
        return;
    }

    const cards = Array.from(container.children);

    cards.forEach((card, index) => {
        const item = data[index];
        const isVisible = Object.entries(filters).every(([key, value]) => {
            if (!value) return true;                                    // Skip empty filters
            if (key === 'startDate' || key === 'endDate') return true;  // Skip date range keys (handled separately)

            // Handle text filtering
            return String(item[key]).toLowerCase().includes(value.toLowerCase());
            }) && (
            // Check if the date falls within the range
            (!filters.startDate || new Date(item.date) >= filters.startDate) &&
            (!filters.endDate || new Date(item.date) <= filters.endDate)
        );

        card.classList.toggle('hide', !isVisible);
    });
}