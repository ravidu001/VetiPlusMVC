// ***************************************************************
// this JS file contains only functions that have to be called in the view file to use with custom parameter
// <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
// ***************************************************************

// for displaying a serviceProvider's avg rating
function displayStarRating(rating, container) {
    if (!container) {
        console.log('Container not found!');
        return;
    }
    container.innerHTML = '';
    
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;
    
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        star.className = 'bx';
        
        if (i <= fullStars)
            star.classList.add('bxs-star');
        else if (i === fullStars + 1 && hasHalfStar)
            star.classList.add('bxs-star-half');
        else star.classList.add('bx-star');
        
        star.classList.add('bx-sm');
        container.appendChild(star);
    }
}

/**
 * Creates a card element based on the template and data object.
 * @param {HTMLElement} template - The template element to clone.
 * @param {Object} data - The data object containing key-value pairs.
 * @returns {HTMLElement} - The created card element.
 */
function createCard(template, data) {
    const card = template.content.cloneNode(true).children[0];
    const picTypes = ['petPic', 'providerPic', 'profilePicture', 'adoptionImage'];
    card.querySelectorAll('.cardPic').forEach(pic => {
        pic.style.display = 'none';
    });

    function isDateTimeeString (str) {
        if (typeof str !== 'string') return false;
        return !isNaN(Date.parse(str));
    }
    
    // Iterate over the data object and populate the card
    for (const [key, value] of Object.entries(data)) {
        const element = card.querySelector(`.${key}`);
        if (element) {
            // handle setting image src:
            if (picTypes.includes(key)) {
                if (value) {
                    let imgSrc;
                    if (key == 'providerPic') {
                        if (data['type'] == 'vet') imgSrc = `${ROOT}/assets/images/vetDoctor/${value}`;
                        else if (data['type'] == 'salon') imgSrc = `${ROOT}/${value}`;
                    } else if (key == 'petPic') {
                        imgSrc = `${ROOT}/assets/images/petOwner/profilePictures/pet/${value}`
                    } else if (key == 'adoptionImage') {
                        imgSrc = `${ROOT}/assets/images/petOwner/profilePictures/adoption/${value}`
                    }
                    element.src = imgSrc;
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            }
            else if(key == "type") {
                let title;
                if(value == 'salon') title= 'salon'; else title = 'Dr.'
                card.querySelector('providerTitle').textContent = title
            }
            // for rating data
            else if (key == 'rating') {
                card.querySelectorAll('.cardBtn').forEach(btn => {
                    btn.style.display = 'none';
                })
                if (value == null) {
                    card.querySelector('.rating').style.display = 'none';
                    card.querySelector('.ratingBtn').style.display = 'flex';
                } else {
                    displayStarRating(value, element);
                }
            }
            else if (key == 'avgRating') {
                if (value == null) {
                    element.innerHTML = '<p style="opacity: 0.8;">No feedback for this user yet.</p>';
                } else {
                    displayStarRating(value, element);
                }
            }
            // else if (isDateTimeeString(value)) {
            //     const dateStr = new Date(value);
            //     const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: false };
            //     element.textContent =  dateStr.toLocaleTimeString('en-GB', options);
            // }
            else if (element.tagName == 'A') {
                element.hasAttribute('href') && element.setAttribute('href', value);
            }
            else element.textContent = value;
        } else {
            if (card.hasAttribute(key)) {
                card.setAttribute(key, value); // Set attributes for the card itself
            }
            // console.log(`${key}`)
            // const button = card.querySelector('button');
            // button && button.hasAttribute(key) && button.setAttribute(key, value);
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
async function fetchAndAppendCards (url, templateSelector, containerSelector) {
    const template = document.querySelector(templateSelector);
    const container = document.querySelector(containerSelector);

    if (!template || !container) {
        console.error('Template or container not found!');
        return;
    }
    container.innerHTML = '<p class="noResults">Loading...</p>';

    try {
        const response = await fetch(url);
        const data = await response.json();
        container.innerHTML = '';

        if (!Array.isArray(data)) {
            if (data.fetchedCount === 0) {
                container.innerHTML = '<p class="noResults">No results found.</p>';
            }
            return;
        }

        data.forEach(item => {
            const card = createCard(template, item);
            card.classList.add('cardFloat');

            if (item.apptStatus == 'cancelled' || (item.apptStatus == 'available' && item.whenType == 'history')) {
                card.classList.add('card-inactive');
            }
            if (item.apptStatus == '1') {
                card.classList.add('card-inactive');
            }

            container.append(card);

            card.addEventListener('animationend', () => {
                card.classList.remove('cardFloat');
            });
        });
        return data;

    } 
    catch (error) {
        console.error('Error fetching data/ Invalid url given');
    }
}


function fillDivData (data, divConatinerSelector) {
    const displayItem = document.querySelector(divConatinerSelector);

    if (!displayItem) {
        console.error('Container not found: ', divConatinerSelector);
        return;
    }

    const picTypes = ['petPic', 'providerPic'];
    displayItem.querySelectorAll('.cardPic').forEach(pic => {
        pic.style.display = 'none';
    });

    function isDatTimeeString (str) {
        if (typeof str !== 'string') return false;
        return !isNaN(Date.parse(str));
    }
    
    // Iterate over the data object and populate the card
    if (data && typeof data === 'object') {
        for (const [key, value] of Object.entries(data)) {
            // console.log(key, value)
            const element = displayItem.querySelector(`.${key}`);
            if (element) {
                // handle setting image src:
                if (picTypes.includes(key)) {
                    if (value) {
                        let imgSrc;
                        if (key == 'providerPic') {
                            if (data['type'] == 'vet') imgSrc = `${ROOT}/assets/images/vetDoctor/${value}`;
                            else if (data['type'] == 'salon') imgSrc = `${ROOT}/${value}`;
                        } else if (key == 'petPic') {
                            imgSrc = `${ROOT}/assets/images/petOwner/profilePictures/pet/${value}`
                        }
                        element.src = imgSrc;
                        element.style.display = 'block';
                    } else {
                        element.style.display = 'none';
                    }
                }
                // for rating data
                else if (key == 'rating') {
                    displayItem.querySelectorAll('.cardBtn').forEach(btn => {
                        btn.style.display = 'none';
                    })
                    if (value == null) {
                        displayItem.querySelector('.rating').style.display = 'none';
                        displayItem.querySelector('.ratingBtn').style.display = 'flex';
                    } else {
                        displayStarRating(value, element);
                    }
                }
                else if (key == 'avgRating') {
                    if (value == null) {
                        element.innerHTML = '<p style="opacity: 0.8;">No feedback for this user yet.</p>';
                    } else {
                        displayStarRating(value, element);
                    }
                }
                else if (isDatTimeeString(value)) {
                    const dateStr = new Date(value);
                    const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true };
                    element.textContent =  dateStr.toLocaleTimeString('en-GB', options);
                }
                else if (element.tagName == 'A') {
                    element.hasAttribute('href') && element.setAttribute('href', value);
                }
                else if (element.tagName == 'INPUT') {
                    element.hasAttribute('value') && element.setAttribute('value', value);
                }
                else element.textContent = value;
            } else {
                if (displayItem.hasAttribute(key)) {
                    displayItem.setAttribute(key, value);
                }
            }
        }
    } else {
        console.error("Not an object!");
    }
    
}