// ***************************************************************
// this JS file contains only functions that have to be called in the view file to use with custom parameter
// <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>

// 0. createCard() is used within fetchAndAppendCards() itself

// 1. fetchAndAppendCards() - the main fetch and card-container append/populator; use something like this:
// let userData; // Store fetched data for filtering
// fetchAndAppendCards(
//     'testing/getAllUsers',
//     '.userCard-template',
//     '.userCard-container'
// ).then(data => {
//     userData = data; // Save fetched data for filtering
// });

// 2. filterCards() - if the displayed cards need to be filtered use something like this:
// const searchFilter = document.querySelector('#searchFilter');
// searchFilter.addEventListener('input', (e) => {
//     const searchValue = e.target.value;
//     filterCards(userData, searchValue, '.userCard-container', ['email', 'type']);
// });

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
            element.textContent = value; // Update text content
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
 * Filters cards based on a search value and updates their visibility.
 * @param {Array} data - The array of data objects used to create the cards.
 * @param {string} searchValue - The search input value.
 * @param {string} containerSelector - The selector for the container holding the cards.
 * @param {Array<string>} filterKeys - The keys in the data object to filter by (e.g., ['email', 'type']).
 */
function filterCards(data, searchValue, containerSelector, filterKeys) {
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error('Container not found!');
        return;
    }

    const cards = Array.from(container.children);

    cards.forEach((card, index) => {
        const item = data[index];
        const isVisible = filterKeys.some(key => 
            String(item[key]).toLowerCase().includes(searchValue.toLowerCase())
        );
        card.classList.toggle('hide', !isVisible);
    });
}