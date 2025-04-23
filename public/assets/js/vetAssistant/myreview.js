// sorting and filtering functions
document.addEventListener('DOMContentLoaded', () => {
    const sortSelect = document.getElementById('sortSelect');
    const statusSelect = document.getElementById('statusSelect');
    const reviewsContainer = document.querySelector('.review-fullcard');

    // Assuming 'reviews' is available in the scope
    // const reviews = <?= json_encode($reviews) ?>; // Pass PHP reviews to JavaScript

    // Function to filter reviews based on status
    // function filterReviews(reviews, status) {
    //     if (status === 'all') {
    //         return reviews; // Return all reviews
    //     } else if (status === 'unread') {
    //         return reviews.filter(review => review.reviewData.status === 0); // Filter unread reviews
    //     } else if (status === 'replied') {
    //         return reviews.filter(review => review.reviewData.status === 1); // Filter replied reviews
    //     }
    // }

    // Function to sort reviews
    function sortReviews(reviews, criteria) {
        return reviews.sort((a, b) => {
            if (criteria === 'date') {
                return new Date(b.reviewData.feedbackDateTime) - new Date(a.reviewData.feedbackDateTime);
            } else if (criteria === 'highestRating') {
                return b.reviewData.rating - a.reviewData.rating;
            } else if (criteria === 'lowestRating') {
                return a.reviewData.rating - b.reviewData.rating;
            }
        });
    }

    function renderReviews(reviews) {
        reviewsContainer.innerHTML = ''; // Clear existing reviews
        reviews.forEach(review => {
            const reviewCard = document.createElement('div');
            reviewCard.className = 'review-card';
            reviewCard.style.marginBottom = '15px'; // Add margin similar to PHP
    
            const reviewDate = new Date(review.reviewData.feedbackDateTime).toLocaleString('en-GB', { // Format date to match PHP
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
    
            reviewCard.innerHTML = `
                <div class="review-details">
                    <div class="review-header">
                        <span class="review-author">${review.doctor.fullName}</span>
                        <span class="review-date">${reviewDate}</span>
                    </div>
                    <div class="review-rating">
                        ${'★'.repeat(review.reviewData.rating)}${'☆'.repeat(5 - review.reviewData.rating)} (${review.reviewData.rating}/5)
                    </div>
                    <p class="review-content">${review.reviewData.comment}</p>
                    <small>Appointment #${review.reviewData.sessionID}</small>
                </div>
                <div class="review-actions">
                    <button class="btn btn-details" onclick="openDetailsModal('${review.doctor.fullName}', '${reviewDate}', '${review.reviewData.rating}', '${review.reviewData.comment}', '${review.reviewData.sessionID}', '${review.reviewData.respond}')">View Details</button>
                </div>
            `;
            reviewsContainer.appendChild(reviewCard);
        });
    }

    // Event listener for status filtering
    // statusSelect.addEventListener('change', () => {
    //     const selectedStatus = statusSelect.value;
    //     const filteredReviews = filterReviews(reviews, selectedStatus);
    //     renderReviews(filteredReviews);
    // });

    // Event listener for sorting
    sortSelect.addEventListener('change', () => {
        const selectedValue = sortSelect.value;
        const sortedReviews = sortReviews(reviews, selectedValue);
        renderReviews(sortedReviews);
    });

    // Initial render of reviews
    renderReviews(reviews); // Assuming 'reviews' is available in the scope
});
    
document.addEventListener('DOMContentLoaded', () => {
const loadingOverlay = document.getElementById('loadingOverlay');
const mainContent = document.getElementById('mainContent');

// Function to remove loading overlay
function removeLoadingOverlay() {
    loadingOverlay.classList.add('hidden');
    mainContent.classList.add('visible');
    
    // Enable scrolling
    document.body.style.overflow = 'auto';
}

// Add click event to the entire document
document.addEventListener('click', (event) => {
    if (loadingOverlay.classList.contains('hidden')) return;
    
    // Prevent multiple triggers
    if (event.target.closest('#loadingOverlay')) {
        removeLoadingOverlay();
    }
});

// Optional: Add keyboard support
document.addEventListener('keydown', (event) => {
    if (loadingOverlay.classList.contains('hidden')) return;
    
    if (event.key === 'Enter' || event.key === ' ') {
        removeLoadingOverlay();
    }
});

// Close modal function
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300); // Match the duration of the fade-out animation
}


// Open details modal function
function openDetailsModal(doctorID, formattedDate, rating, comment, sessionID) {
    // Populate the modal with the relevant review details
    document.querySelector('.review-detail-value[data-label="reviewer"]').textContent = doctorID;
    document.querySelector('.review-detail-value[data-label="date"]').textContent = formattedDate;

    // Generate star rating display
    const ratingContainer = document.querySelector('.review-detail-value[data-label="rating"]');
    ratingContainer.innerHTML = ''; // Clear previous content
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            ratingContainer.innerHTML += '<span class="star filled">★</span>'; // Filled star
        } else {
            ratingContainer.innerHTML += '<span class="star empty">☆</span>'; // Empty star
        }
    }
    ratingContainer.innerHTML += ` (${rating}/5)`; // Append the rating text

    document.querySelector('.review-detail-value[data-label="content"]').textContent = comment;
    document.querySelector('.review-detail-value[data-label="sessionID"]').textContent = `#${sessionID}`;
    

    // Show the modal
    const modal = document.getElementById('detailsModal');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10); // Allow time for display to take effect
}

// Click outside modal to close
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal('detailsModal');
    }
}

// Expose functions to global scope if needed
window.closeModal = closeModal;
window.openDetailsModal = openDetailsModal;
});