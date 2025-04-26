<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/request.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/myreview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/"> -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/viewsession.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
         
        
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/assistantnav.php'; ?>
<div class="home">
    <div class="dashboard-container">
        <!-- Profile Header -->
        <div class="dashboard-header">
            <div class="profile-section">
                <div class="profile-avatar">
                    <img src= "<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($assistantData->profilePicture); ?>" alt="Dr. Profile">
                    <!-- <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Profile"> -->
                </div>
                <div>
                    <h1>Dr. <?= htmlspecialchars($assisName); ?></h1>
                    <p><?= htmlspecialchars($assistantData->expertise); ?> | <?= htmlspecialchars($assistantData->experience); ?> Years Experience</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats">
            <div class="stat-card animated-section">
                <i class="ri-timer-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number"><?= htmlspecialchars($pendingCount); ?></div>
                    <div class="stat-label">Pending Request</div>
                </div>
            </div>
            <div class="stat-card animated-section">
                <i class="ri-calendar-check-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number"><?= htmlspecialchars($acceptedCount); ?></div>
                    <div class="stat-label">Total Accepted Request</div>
                </div>
            </div>
            <!-- <div class="stat-card animated-section">
                <i class="ri-money-dollar-circle-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number">$12,500</div>
                    <div class="stat-label">Monthly Revenue</div>
                </div>
            </div>  -->
            <div class="stat-card animated-section">
                <i class="ri-star-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number"><?= htmlspecialchars($reviewCount); ?></div>
                    <div class="stat-label">Total Reviews</div>
                </div>
            </div>
        </div>

        <!-- Upcoming Sessions -->
        <div class="upcoming-sessions animated-section">
            <h2>Upcoming Session</h2>
            <table class="request-table" style="padding-left:10px; padding-right:10px;">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="acceptedRequestsTableBody">
            <?php if (!empty($data['consolidatedData'])): ?>
                    <?php foreach ($data['consolidatedData'] as $request): ?>
                        <tr>
                            <td>
                                <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($request['doctor']->profilePicture) ?>" alt="Profile Picture" class="doctor-profile"><br>
                                <?= htmlspecialchars($request['doctor']->fullName) ?><br>
                                Gender: <?= htmlspecialchars($request['doctor']->gender) ?><br>
                                <?php
                                    $dob = new DateTime($request['doctor']->DOB); // Create a DateTime object for the DOB
                                    $currentDate = new DateTime(); // Get the current date
                                    $age = $currentDate->diff($dob)->y; // Calculate the difference in years
                                ?>
                                Age: <?= htmlspecialchars($age) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($request['session']->selectedDate) ?><br>
                                <?php
                                    $startTime = new DateTime($request['session']->startTime);
                                    $endTime = new DateTime($request['session']->endTime);
                                ?>
                                <?= htmlspecialchars($startTime->format('H:i')) ?> - <?= htmlspecialchars($endTime->format('H:i')) ?>
                            </td>
                            <td><?= htmlspecialchars($request['session']->clinicLocation) ?></td>
                            <td><?= htmlspecialchars($request['doctor']->contactNumber) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-reject">
                                        <a href="<?= ROOT ?>/assisaccepted/reject?sessionID=<?= urlencode($request['session']->sessionID) ?>&assistantID=<?= urlencode($request['assisSession']->assistantID) ?>&selectedDate=<?= urlencode($request['session']->selectedDate) ?>" class="btn-reject">Reject</a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No accepted appointments available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

        <div class="upcoming-sessions animated-section">
        <div class="reviews-container">
            <h2>Latest Reviews</h2>
            <div class="reviews-grid">
                <!-- Previous review cards -->
                 <?php $count = 0; ?>
                <?php foreach ($reviews as $review): ?>
                    <?php if ($count >= 3) break; ?>
                    <div class="review-card" style="margin-bottom: 15px;">
                        <div class="review-details">
                            <div class="review-header">
                                <span class="review-author"><?= $review['doctor']->fullName ?></span>
                                <?php $date = new DateTime($review['reviewData']->feedbackDateTime); ?>
                                <?php $formattedDate = $date->format('d/m/Y H:i'); ?>
                                <span class="review-date"><?= $formattedDate ?></span>
                            </div>
                            <div class="review-rating">
                                <?php 
                                    $rating = $review['reviewData']->rating; // Assuming rating is out of 5
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<span class="star filled">★</span>'; // Filled star
                                        } else {
                                            echo '<span class="star empty">☆</span>'; // Empty star
                                        }
                                    }
                                ?>
                                <span>(<?= $rating ?>/5)</span>
                            </div>
                            <p class="review-content"><?= $review['reviewData']->comment ?></p>
                            <small>Session #<?= $review['reviewData']->sessionID ?></small>
                        </div>
                        <div class="review-actions">
                            <?php if ($review['reviewData']->status): ?>
                                <!-- <span class="review-responded">Replied</span> -->
                                <button class="btn btn-details" 
                                        onclick="openDetailsModal(
                                        '<?= htmlspecialchars($review['doctor']->fullName) ?>', 
                                        '<?= htmlspecialchars($formattedDate) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->rating) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->comment) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->sessionID) ?>'
                                    )">
                                    View Details
                                </button>
                            <?php else: ?>
                            <!-- <button class="btn btn-reply" onclick="">Reply</button> -->
                            <!-- <button class="btn btn-details" 
                                    onclick="">
                                View Details
                            </button> -->
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $count++; ?>
                    
                <?php endforeach; ?>
            </div>
        </div>
        </div>

        <!-- Reply Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Reply to Review</h2>
                <button class="modal-close" onclick="closeModal('replyModal')">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea 
                    id="replyTextarea" 
                    class="reply-textarea" 
                    placeholder="Write your professional and compassionate response here..."
                    maxlength="500"
                    oninput="updateCharCount(this)"
                ></textarea>
                <div class="character-count" id="charCount">0 / 500</div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="closeModal('replyModal')">
                    <span class="material-icons">cancel</span> Cancel
                </button>
                <button class="btn btn-reply" onclick="sendReply()">
                    <span class="material-icons">send</span> Send Reply
                </button>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Review Details</h2>
                <button class="modal-close" onclick="closeModal('detailsModal')">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="review-detail-item">
                    <span class="review-detail-label">Reviewer</span>
                    <span class="review-detail-value">Kasun Perera</span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Date</span>
                    <span class="review-detail-value">17/11/2024</span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Rating</span>
                    <span class="review-detail-value">
                        <span style="color: #ffc107;">★★★★★</span> (5/5)
                    </span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Content</span>
                    <span class="review-detail-value">Great service! My pet received excellent care.</span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Appointment ID</span>
                    <span class="review-detail-value">#7</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="closeModal('detailsModal')">
                    <span class="material-icons">done</span> Close
                </button>
            </div>
        </div>
    </div>
    </div>
</div>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const actionButtons = document.querySelectorAll('.action-btn');

        //     actionButtons.forEach(button => {
        //         button.addEventListener('click', function() {
        //             alert('Action button clicked!');
        //         });
        //     });
        // });

        // document.addEventListener('DOMContentLoaded', () => {
// const loadingOverlay = document.getElementById('loadingOverlay');
// const mainContent = document.getElementById('mainContent');

// Function to remove loading overlay
// function removeLoadingOverlay() {
//     loadingOverlay.classList.add('hidden');
//     mainContent.classList.add('visible');
    
//     // Enable scrolling
//     document.body.style.overflow = 'auto';
// }

// Add click event to the entire document
// document.addEventListener('click', (event) => {
//     if (loadingOverlay.classList.contains('hidden')) return;
    
//     // Prevent multiple triggers
//     if (event.target.closest('#loadingOverlay')) {
//         removeLoadingOverlay();
//     }
// });

// Optional: Add keyboard support
// document.addEventListener('keydown', (event) => {
//     if (loadingOverlay.classList.contains('hidden')) return;
    
//     if (event.key === 'Enter' || event.key === ' ') {
//         removeLoadingOverlay();
//     }
// });

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
function openReplyModal() {
    document.getElementById('replyTextarea').value = ''; // Clear previous content
    document.getElementById('charCount').textContent = '0 / 500'; // Reset character count
    
    const modal = document.getElementById('replyModal');
    modal.style.display = 'flex';
    modal.style.backdropFilter = 'blur(5px)'; 
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10); // Allow time for display to take effect
}

// Open details modal function
function openDetailsModal() {
    const modal = document.getElementById('detailsModal');
    modal.style.display = 'flex';
    modal.style.backdropFilter = 'blur(5px)'; 
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
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

    </script>
</body>
</html>