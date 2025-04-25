/**
 * Filters cards based on multiple filter criteria and updates their visibility.
 * @param {Array} data - The array of data objects used to create the cards.
 * @param {Object} filters - An object containing filter values (e.g., { email: 'example@test.com', type: 'vet doctor', startDate: Date, endDate: Date })
 * 
 * @param {string} containerSelector - The selector for the container holding the cards.
 */
function filterCards(data, filters, containerSelector) {

    // a function to check if a string is a valid date format:
    function isDateString(str) {
        if (typeof str !== 'string') return false;
        return !isNaN(Date.parse(str));
    }
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
            // console.log(`Filtering ${item[key]} with value: ${value}`)
            return String(item[key]).toLowerCase().includes(value.toLowerCase());
            }) && (
            // Check if the date falls within the range
            (!filters.startDate || new Date(item.date) >= filters.startDate) &&
            (!filters.endDate || new Date(item.date) <= filters.endDate)
        );

        card.classList.toggle('hide', !isVisible);
    });
    console.log("filterEnd");
}



function sortCards(data, filters, containerSelector) {
    function isDateString(str) {
        if (typeof str !== 'string') return false;
        return !isNaN(Date.parse(str));
    }
    
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error('Container not found!');
        return;
    }

    // Calculate match score for each item
    const scoredItems = data.map((item, index) => {
        let score = 0;
        const card = container.children[index];
        
        // Check each filter
        Object.entries(filters).forEach(([key, value]) => {
            if (!value) return; // Skip empty filters
            
            if (value instanceof Date || isDateString(value)) {
                const cardDate = new Date(item[key]);
                if (cardDate >= new Date(value)) score++;
            } else if (typeof value === 'string') {
                String(item[key]).toLowerCase().includes(value.toLowerCase()) && score++;
            }
        });
        
        return { item, card, score };
    });

    // Sort by score (highest first), then by original position
    scoredItems.sort((a, b) => {
        if (a.score !== b.score) return b.score - a.score;
        return data.indexOf(a.item) - data.indexOf(b.item);
    });

    // Rebuild the container with sorted cards
    container.innerHTML = '';
    scoredItems.forEach(({ card }) => {
        container.appendChild(card); // Re-add cards in new order
    });
    
}