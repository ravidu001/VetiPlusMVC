const completeButtons = document.querySelectorAll('.btn-complete');
const cancelButtons = document.querySelectorAll('.btn-cancel');
const completedTableBody = document.querySelector('#completed tbody');
const cancelledTableBody = document.querySelector('#cancelled tbody');

completeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const appointmentID = row.dataset.appointmentId;
        const ownerName = row.dataset.owner;
        const petImg = row.dataset.petImg;
        const petDetails = `${row.dataset.petName} (${row.dataset.petType}, ${row.dataset.petAge})`;
        const contact = row.dataset.contact;
        const session = row.dataset.session;

        const newRow = `<tr>
            <td>${ownerName}</td>
            <td>
                <div class="pet-profile">
                    <img src="${petImg}" alt="Pet">
                </div>
            </td>
            <td>${petDetails}</td>
            <td>${contact}</td>
            <td>${session}</td>
        </tr>`;
        completedTableBody.insertAdjacentHTML('beforeend', newRow);
        row.remove();

        // Update the appointment status to completed
        updateAppointmentStatus(appointmentID, 'completed');
    });
});

cancelButtons.forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const appointmentID = row.dataset.appointmentId;
        const ownerName = row.dataset.owner;
        const petImg = row.dataset.petImg;
        const petDetails = `${row.dataset.petName} (${row.dataset.petType}, ${row.dataset.petAge})`;
        const contact = row.dataset.contact;
        const session = row.dataset.session;

        const newRow = `<tr>
            <td>${ownerName}</td>
            <td>
                <div class="pet-profile">
                    <img src="${petImg}" alt="Pet">
                </div>
            </td>
            <td>${petDetails}</td>
            <td>${contact}</td>
            <td>${session}</td>
        </tr>`;
        cancelledTableBody.insertAdjacentHTML('beforeend', newRow);
        row.remove();

        // Update the appointment status to cancelled
        updateAppointmentStatus(appointmentID, 'cancelled');
    });
});

// Function to update appointment status
function updateAppointmentStatus(appointmentID, status) {
    fetch('/VetiPlusMVC/public/DoctorViewSession/updateAppointment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            appointmentID: appointmentID,
            status: status
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Optionally handle success (e.g., show a message)
    })
    .catch((error) => {
        console.error('Error:', error);
        // Optionally handle error (e.g., show an error message)
    });
}

// Tab Switching Logic
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        const target = this.dataset.target;
        document.querySelectorAll('.animated-section').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(target).style.display = 'block';
    });
});

// Smooth Animation for Tab Switching
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.status-buttons .btn');
    const sections = document.querySelectorAll('.animated-section');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            sections.forEach(section => {
                section.style.display = section.id === target ? 'block' : 'none';
            });
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

// Star Rating Class (from previous example)
class StarRating {
    constructor(rating, options = {}) {
        this.rating = rating;
        this.options = {
            maxStars: 5,
            starColor: '#ffc107',
            backgroundStarColor: '#e0e0e0',
            size: 1.2,
            // ...options
        };
    }

    renderStars() {
        const fullStars = Math.floor(this.rating);
        const decimalPart = this.rating % 1;

        let starsHTML = '';
        
        // Background (empty) stars
        for (let i = 0; i < this.options.maxStars; i++) {
            starsHTML += `<i class="ri-star-line" style="color: ${this.options.backgroundStarColor}; font-size: ${this.options.size}rem;"></i>`;
        }

        // Foreground (filled) stars with precise width
        const filledWidth = `${(this.rating / this.options.maxStars) * 100}%`;
        
        return `
            <div class="rating-container">
                <div class="rating-stars">
                    <div class="rating-stars-background">
                        ${starsHTML}
                    </div>
                    <div class="rating-stars-foreground" style="width: ${filledWidth}">
                        ${starsHTML}
                    </div>
                </div>
                <span class="rating-value">${this.rating.toFixed(1)}</span>
            </div>
        `;
    }

    static createDetailedStar(rating) {
        const fullStars = Math.floor(rating);
        // window.alert(fullStars);
        const decimalPart = rating % 1;
        // window.alert(decimalPart);

        let starsHTML = '';
        
        // Full stars
        for (let i = 0; i < fullStars; i++) {
            starsHTML += '<i class="ri-star-fill"></i>';
        }

        // Partial star handling
        if (decimalPart > 0) {
            starsHTML += `
                <span class="star-detailed">
                    <span class="star-half">
                        <i class="ri-star-half-line"></i>
                    </span>
                </span>
            `;
        }

        // Remaining empty stars
        const remainingStars = 5 - Math.ceil(rating);
        for (let i = 0; i < remainingStars; i++) {
            starsHTML += '<i class="ri-star-line"></i>';
        }

        return `
            <div class="rating-container">
                <div class="rating-stars">
                    ${starsHTML}
                </div>
                <span class="rating-value">${rating.toFixed(1)}</span>
            </div>
        `;
    }
}

// Render Assistant Rating on Page Load
document.addEventListener('DOMContentLoaded', () => {
    const assistantRatingContainer = document.getElementById('assistant-rating');
    
    // Method 1: Smooth Gradient Rendering
    // const smoothRating = new StarRating(4.5);
    // assistantRatingContainer.innerHTML = smoothRating.renderStars();

    // Optional: If you want to show both rendering methods
    const alternativeRatingContainer = document.createElement('div');
    const detailedRating = StarRating.createDetailedStar(3.5);
    alternativeRatingContainer.innerHTML = detailedRating;
    assistantRatingContainer.appendChild(alternativeRatingContainer);
});

// Additional Rating Rendering Examples
// function renderMultipleRatings() {
//     const ratings = [4.5, 4.2, 4.7, 3.8];
//     const container = document.createElement('div');
    
//     ratings.forEach(rating => {
//         const ratingElement = document.createElement('div');
//         const smoothRating = new StarRating(rating);
//         ratingElement.innerHTML = smoothRating.renderStars();
//         container.appendChild(ratingElement);
//     });

//     document.body.appendChild(container);
// }