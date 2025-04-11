<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Assistant Reviews</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/toreview.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="review-container">
        <div class="review-header">
            <h1>Vet Assistant Reviews</h1>
            <div class="review-tabs">
                <button class="tab-button active" onclick="switchTab('pending')">Pending Reviews</button>
                <button class="tab-button" onclick="switchTab('completed')">Completed Reviews</button>
            </div>
        </div>

        <div id="pendingReviews" class="review-grid">
            <!-- Pending Review Cards -->
            <?php if (!empty($pendingReviews)): ?>
                <?php foreach ($pendingReviews as $review): ?>
                    <div class="review-card">
                        <div class="assistant-profile">
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= $review['assistantProfileImage'] ?>" alt="Assistant Profile">
                            <div class="assistant-details">
                                <h3><?= $review['assistantName'] ?></h3>
                                <p>Session: <?= $review['sessionDate'] ?></p>
                            </div>
                        </div>
                        <div class="review-details">
                            <p>Location: <?= $review['location'] ?></p>
                            <p>Time: <?= $review['time'] ?></p>
                        </div>
                        <div class="review-actions">
                            <button class="review-button" onclick="openReviewModal('<?= $review['assistantSessionID'] ?>', '<?= $review['assistantID'] ?>', '<?= $review['assistantName'] ?>', '<?= $review['assistantProfileImage'] ?>')">Review</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-reviews">No pending reviews available.</p>
            <?php endif; ?>
        </div>

        <div id="completedReviews" class="review-grid" style="display: none;">
            <!-- Completed Review Cards -->
            <?php if (!empty($completedReviews)): ?>
                <?php foreach ($completedReviews as $review): ?>
                    <div class="review-card">
                        <div class="assistant-profile">
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= $review['assistantProfileImage'] ?>" alt="Assistant Profile">
                            <div class="assistant-details">
                                <h3><?= $review['assistantName'] ?></h3>
                                <p>Session: <?= $review['sessionDate'] ?></p>
                            </div>
                        </div>
                        <div class="review-details">
                            <p>Your Review: <?= $review['comment'] ?></p>
                            <div class="review-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class='bx <?= $i <= $review['rating'] ? "bxs-star" : "bx-star" ?>'></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="review-actions">
                            <!-- <button class="review-button" onclick="openReviewModal('<?= $review['sessionID'] ?>', '<?= $review['assistantID'] ?>', '<?= $review['assistantName'] ?>', '<?= $review['assistantProfileImage'] ?>')">Review</button> -->
                            <button class="delete-button" onclick="deleteReview('<?= $review['sessionID'] ?>', '<?= $review['assistantID'] ?>')">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-reviews">No completed reviews available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="reviewModal" class="modal">
        <form method="post" id="reviewModelForm" action="<?= ROOT ?>/DoctorToreview/submitReview">
            <div class="feedback-modal active">
                <div class="modal-header">
                    <img src="" id="modalProfileImage" alt="Profile" class="profile-image">
                    <h2 class="modal-title">Provide Feedback for <span id="modalAssistantName"></span></h2>
                </div>

                <input type="hidden" id="assistantSessionID" name="assistantSessionID" value="">
                <input type="hidden" id="sessionID" name="sessionID" value="">
                <input type="hidden" id="assistantID" name="assistantID" value="">
        
                <div class="rating">
                    <div class="star-widget"> 
                        <input type="radio" name="rate" id="rate-5" value="5">
                        <label for="rate-5" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-4" value="4">
                        <label for="rate-4" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-3" value="3">
                        <label for="rate-3" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-2" value="2">
                        <label for="rate-2" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-1" value="1">
                        <label for="rate-1" class="fas fa-star"></label>
                    </div>
                </div>

                <textarea class="feedback-textarea" id="feedbackText" name="feedback" placeholder="Share your detailed feedback here..."></textarea>

                <div class="button-group">
                    <button type="button" class="btn btn-cancel" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-submit">Submit Feedback</button>
                </div>
            </div>
        </form>
    </div>

    <!-- confimation delete model -->
    <div id="deleteConfirmModal" class="modal">
    <div class="delete-confirm-content">
        <div class="delete-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this review? This action cannot be undone.</p>
        <div class="button-group">
            <button id="cancelDeleteBtn" class="btn btn-cancel">Cancel</button>
            <button id="confirmDeleteBtn" class="btn btn-delete">Delete Review</button>
        </div>
    </div>
</div>
</div>

<script>
    function switchTab(tab) {
        // Show/hide appropriate tab content
        const pendingTab = document.getElementById('pendingReviews');
        const completedTab = document.getElementById('completedReviews');
        const tabButtons = document.querySelectorAll('.tab-button');
        
        if (tab === 'pending') {
            pendingTab.style.display = 'grid';
            completedTab.style.display = 'none';
        } else {
            pendingTab.style.display = 'none';
            completedTab.style.display = 'grid';
        }
        
        // Update active tab button
        tabButtons.forEach(button => {
            button.classList.remove('active');
        });
        event.target.classList.add('active');
    }
    
    function openReviewModal(sessionID, assistantID, assistantName, profileImage, rating = 0, comment = '') {
        // Set modal content
        document.getElementById('sessionID').value = sessionID;
        document.getElementById('assistantID').value = assistantID;
        document.getElementById('modalAssistantName').textContent = assistantName;
        document.getElementById('modalProfileImage').src = profileImage;
        document.getElementById('feedbackText').value = comment;

        // alert notification
        // alert(sessionID);
        
        // Set rating if editing an existing review
        if (rating > 0) {
            document.getElementById(`rate-${rating}`).checked = true;
        }

        const imageUrl = profileImage; 
        // Set the src attribute of the img tag
        document.getElementById('modalProfileImage').src = '<?= ROOT ?>/assets/images/vetAssistant/' + imageUrl;

        // Show modal
        document.getElementById('reviewModal').style.display = 'flex';
    }

    document.getElementById('reviewModelForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get form data
        const formData = new FormData(this);
        
        // Send AJAX request
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showFeedbackMessage('Review submitted successfully!', 'success');
                
                // Redirect after showing the message (optional)
                setTimeout(() => {
                    window.location.href = data.redirectUrl;
                }, 2000); // Redirect after 2 seconds
            } else {
                // Show error message
                showFeedbackMessage('Error submitting review. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showFeedbackMessage('An error occurred. Please try again.', 'error');
        });
    });

    let deleteSessionID = null;
    let deleteAssistantID = null;
    const ROOT = '<?= ROOT ?>';
    function deleteReview(sessionID, assistantID) {
        // Store the IDs for later use
        deleteSessionID = sessionID;
        deleteAssistantID = assistantID;

        // Show the delete confirmation modal
        document.getElementById('deleteConfirmModal').style.display = 'flex';
    }

    // Add this code to handle the delete confirmation modal
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteConfirmModal');
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        
        // Close modal when cancel button is clicked
        cancelBtn.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });
        
        // Handle delete confirmation
        confirmBtn.addEventListener('click', function() {
            // If we have valid IDs stored, proceed with deletion
            if (deleteSessionID !== null && deleteAssistantID !== null) {
                // Send AJAX request to delete the review
                const xhr = new XMLHttpRequest(); 
                xhr.open('POST', ROOT + '/DoctorToreview/deleteReview', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
                // Show a loading state on the button
                confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                confirmBtn.disabled = true;
                
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // Show success message before reload
                                showFeedbackMessage('Review successfully deleted', 'success');
                                
                                // Reload the page after a short delay
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                showFeedbackMessage('Failed to delete review', 'error');
                                confirmBtn.innerHTML = 'Delete Review';
                                confirmBtn.disabled = false;
                            }
                        } catch (e) {
                            showFeedbackMessage('An error occurred', 'error');
                            confirmBtn.innerHTML = 'Delete Review';
                            confirmBtn.disabled = false;
                        }
                    } else {
                        showFeedbackMessage('Server error', 'error');
                        confirmBtn.innerHTML = 'Delete Review';
                        confirmBtn.disabled = false;
                    }
                };
                
                xhr.onerror = function() {
                    showFeedbackMessage('Connection error', 'error');
                    confirmBtn.innerHTML = 'Delete Review';
                    confirmBtn.disabled = false;
                };
                
                xhr.send('sessionID=' + deleteSessionID + '&assistantID=' + deleteAssistantID);
            }
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });
    });

    // Feedback message function for user notifications
    function showFeedbackMessage(message, type) {
        // Check if feedback container exists, create if not
        let feedbackContainer = document.getElementById('feedbackContainer');
        if (!feedbackContainer) {
            feedbackContainer = document.createElement('div');
            feedbackContainer.id = 'feedbackContainer';
            feedbackContainer.style.position = 'fixed';
            feedbackContainer.style.top = '20px';
            feedbackContainer.style.right = '20px';
            feedbackContainer.style.zIndex = '1001';
            document.body.appendChild(feedbackContainer);
        }
        
        // Create message element
        const messageElement = document.createElement('div');
        messageElement.className = 'feedback-message ' + type;
        messageElement.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        
        // Style the message
        messageElement.style.backgroundColor = type === 'success' ? '#4CAF50' : '#F44336';
        messageElement.style.color = 'white';
        messageElement.style.padding = '12px 20px';
        messageElement.style.marginBottom = '10px';
        messageElement.style.borderRadius = '5px';
        messageElement.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
        messageElement.style.display = 'flex';
        messageElement.style.alignItems = 'center';
        messageElement.style.animation = 'slideInRight 0.3s forwards';
        
        // Add keyframes for animation if not already in the document
        if (!document.getElementById('feedbackAnimation')) {
            const style = document.createElement('style');
            style.id = 'feedbackAnimation';
            style.innerHTML = `
                @keyframes slideInRight {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes fadeOut {
                    from { opacity: 1; }
                    to { opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
        
        // Add to container
        feedbackContainer.appendChild(messageElement);
        
        // Remove after 3 seconds
        setTimeout(() => {
            messageElement.style.animation = 'fadeOut 0.3s forwards';
            setTimeout(() => {
                feedbackContainer.removeChild(messageElement);
            }, 300);
        }, 3000);
    }
    
    // Close modal when cancel button is clicked
    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('reviewModal').style.display = 'none';
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('reviewModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Example of additional functionality that could be added:
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional initialization code here
    
    // For example, transition animations for the review cards
    const reviewCards = document.querySelectorAll('.review-card');
    reviewCards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.1) + 's';
        card.classList.add('animated');
    });
});
</script>
</body>
</html>