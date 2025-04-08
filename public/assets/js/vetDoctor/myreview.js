// document.addEventListener('DOMContentLoaded', () => {
// const reviewNotification = document.getElementById('reviewNotification');
// const loadingMessage = document.getElementById('loadingMessage');

// Function to check and display review notifications
//     function checkReviewNotifications() {
//         // Simulate fetching review data (replace with actual backend call)
//         fetch('')
//             .then(response => response.json())
//             .then(data => {
//                 const newReviewCount = data.newReviewCount;
//                 // set the new review count as 1
//                 newReviewCount = 1;

//                 if (newReviewCount > 0) {
//                     // Exciting message for new reviews
//                     // window.alert('You have new reviews waiting to be checked!');
//                     reviewNotification.innerHTML = `
//                         <div class="review-alert">
//                             <span class="review-icon">🌟</span>
//                             <p>Exciting News! You have ${newReviewCount} 
//                                ${newReviewCount === 1 ? 'new review' : 'new reviews'} 
//                                waiting to be checked!</p>
//                         </div>
//                     `;
//                     loadingMessage.textContent = 'New Reviews Arrived!';
//                 } else {
//                     // Motivational message when no new reviews
//                     reviewNotification.innerHTML = `
//                         <div class="no-review-alert">
//                             <span class="no-review-icon">📊</span>
//                             <p>No new reviews at the moment. 
//                                Keep providing exceptional care!</p>
//                         </div>
//                     `;
//                     loadingMessage.textContent = 'Stay Motivated';
//                 }
//             })
//             .catch(error => {
//                 // Fallback in case of error
//                 reviewNotification.innerHTML = `
//                     <div class="error-alert">
//                         <span class="error-icon">⚠️</span>
//                         <p>Unable to fetch review updates. 
//                            Please check your connection.</p>
//                     </div>
//                 `;
//                 loadingMessage.textContent = 'Connection Issue';
//             });
//     }

//     // Call the function to check reviews
//     checkReviewNotifications();
// });
    
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

// Character count update function
function updateCharCount(textarea) {
    const charCount = document.getElementById('charCount');
    charCount.textContent = `${textarea.value.length} / ${textarea.maxLength}`;
    
    // Optional: Change color if approaching limit
    if (textarea.value.length > 400) {
        charCount.style.color = 'red';
    } else {
        charCount.style.color = '#888';
    }
}

// Send reply function
function sendReply() {
    const replyTextarea = document.getElementById('replyTextarea');
    const replyContent = replyTextarea.value.trim();
    
    if (replyContent) {
        // Logic to send the reply (e.g., AJAX call to the server)
        alert('Reply sent: ' + replyContent);
        closeModal('replyModal');
        replyTextarea.value = ''; // Clear the textarea
        document.getElementById('charCount').textContent = '0 / 500'; // Reset character count
    } else {
        alert('Please write a reply before sending.');
    }
}

// Close modal function
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300); // Match the duration of the fade-out animation
}

// Open reply modal function
function openReplyModal(feedbackID) {
    document.getElementById('replyTextarea').value = ''; // Clear previous content
    document.getElementById('charCount').textContent = '0 / 500'; // Reset character count
    document.getElementById('feedbackID').value = feedbackID; // Set the feedbackID

    const modal = document.getElementById('replyModal');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10); // Allow time for display to take effect
}

// Send reply function
function sendReply() {
    const replyTextarea = document.getElementById('replyTextarea');
    const replyContent = replyTextarea.value.trim();
    const feedbackID = document.getElementById('feedbackID').value; // Get the feedbackID

    if (replyContent) {
        // Logic to send the reply (e.g., AJAX call to the server)
        fetch('/VetiPlusMVC/public/DoctorReview/sendReply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                feedbackID: feedbackID,
                replyContent: replyContent
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reply sent successfully!');
                closeModal('replyModal');
                replyTextarea.value = ''; // Clear the textarea
                document.getElementById('charCount').textContent = '0 / 500'; // Reset character count
                
                // Refresh the page
                location.reload();
            } else {
                alert('Failed to send reply: ' + data.message);
            }
        })
        .catch(error => {
            console.log('Error sending reply: ' + error);
        });
    } else {
        alert('Please write a reply before sending.');
    }
}

// Open details modal function
function openDetailsModal(petOwnerID, formattedDate, rating, comment, appointmentID, response) {
    // Populate the modal with the relevant review details
    document.querySelector('.review-detail-value[data-label="reviewer"]').textContent = petOwnerID;
    document.querySelector('.review-detail-value[data-label="date"]').textContent = formattedDate;
    document.querySelector('.review-detail-value[data-label="rating"]').innerHTML = `<span style="color: #ffc107;">★★★★★</span> (${rating}/5)`;
    document.querySelector('.review-detail-value[data-label="content"]').textContent = comment;
    document.querySelector('.review-detail-value[data-label="appointmentID"]').textContent = `#${appointmentID}`;
    
    const responseElement = document.querySelector('.review-detail-value[data-label="response"]');
    responseElement.textContent = response ? response : 'No response yet';

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
        closeModal('replyModal');
        closeModal('detailsModal');
    }
}

// Expose functions to global scope if needed
window.updateCharCount = updateCharCount;
window.sendReply = sendReply;
window.closeModal = closeModal;
window.openReplyModal = openReplyModal;
window.openDetailsModal = openDetailsModal;
});