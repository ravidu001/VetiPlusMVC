<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/myreview.css">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/"> -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/viewsession.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
         :root {
            --body-color: #F4F7FA;
            --primary-color: #6a0dad;
            --background-light: #c8a2c8;
            --background-white: #ffffff;
            --text-primary: #333;
            --text-secondary: #6c757d;
            --border-color: #e0e4e8;
            --transition: all 0.3s ease;
        } 

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        } 

        body {
            background: var(--body-color);
            line-height: 1.6;
        } 

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-section {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));            padding: 20px;
            border-radius: 12px;
            color: white;
            box-shadow: 0 10px 30px rgba(106, 13, 173, 0.2);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
            border: 4px solid rgba(255,255,255,0.3);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--background-white);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: var(--transition);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            opacity: 0.7;
        }

        .stat-content {
            text-align: right;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .upcoming-sessions {
            background: var(--background-white);
            border-radius: 12px;
            padding-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .upcoming-sessions h2 {
            padding: 20px 0 0 10px;
        }

        .session-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .session-table th {
            background: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .session-table td {
            background: #f9f9f9;
            padding: 15px;
            transition: var(--transition);
        }

        .session-table tr:hover td {
            background: var(--background-light);
            color: white;
        }

        .action-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .action-btn:hover {
            background: var(--background-light);
        }

        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animated-section {
            animation: fadeIn 0.5s ease forwards;
        }

        .modal {
            backdrop-filter: none !important; /* Override the external CSS */
            background-color: rgba(0, 0, 0, 0);
            overflow: auto; 
        }

        html, body {
            overflow: auto; /* or overflow: scroll; */
            height: 100%;
            scroll-behavior: smooth;
        }

        .reviews-container {
            padding:10px;
            margin-bottom:0;
        }

        .reviews-container h2 {
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="dashboard-container">
        <!-- Profile Header -->
        <div class="dashboard-header">
            <div class="profile-section">
                <div class="profile-avatar">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Profile">
                </div>
                <div>
                    <h1>Dr. Kamal Perera</h1>
                    <p>Veterinary Specialist | 10 Years Experience</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats">
            <div class="stat-card animated-section">
                <i class="ri-calendar-check-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number">124</div>
                    <div class="stat-label">Total Appointments</div>
                </div>
            </div>
            <div class="stat-card animated-section">
                <i class="ri-user-heart-line stat-icon"></i>
                <div class="stat-content">
                    <div class="stat-number">42</div>
                    <div class="stat-label">Patients This Month</div>
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
                    <div class="stat-number">150</div>
                    <div class="stat-label">Total Reviews</div>
                </div>
            </div>
        </div>

        <!-- Upcoming Sessions -->
        <div class="upcoming-sessions animated-section">
            <h2>Upcoming Sessions</h2>
            <table class="sessions-table">
            <thead>
                <tr>
                    <th>Session</th>
                    <th>Assistant</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Appointments</th>
                    <!-- <th>Status</th> -->
                    <th>
                        <!-- Actions -->
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>
                        <div class="vet-info">
                            <div class="vet-avatar">
                                <img src="<?= ROOT ?>/assets/images/vetAssistant/assistant.jpg" alt="assistant">
                            </div>
                            <div class="vet-details">
                                <span class="vet-name">Kasun Perera</span>
                                <span class="vet-specialization">Small Animal Care</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        2025/01/15<br>
                        15:00 - 17:00
                    </td>
                    <td>147, Galthude, Panadura</td>
                    <td>10</td>
                    <!-- <td>
                        <span class="session-status status-confirmed">Confirmed</span>
                    </td> -->
                    <td>
                        <a href="<?= ROOT ?>/DoctorViewSession/session" class="view-btn">
                            <i class='bx bx-right-arrow-circle'></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>

        <div class="upcoming-sessions animated-section">
        <div class="reviews-container">
            <h2>Latest Reviews</h2>
            <div class="reviews-grid">
                <!-- Previous review cards -->
                <div class="review-card">
                    <div class="review-details">
                        <div class="review-header">
                            <span class="review-author">Kasun Perera</span>
                            <span class="review-date">17/11/2024</span>
                        </div>
                        <div class="review-rating">
                            ★★★★★ (5/5)
                        </div>
                        <p class="review-content">Great service! My pet received excellent care.</p>
                        <small>Appointment #7</small>
                    </div>
                    <div class="review-actions">
                        <button class="btn btn-reply" onclick="openReplyModal()">Reply</button>
                        <button class="btn btn-details" onclick="openDetailsModal()">View Details</button>
                    </div>
                </div>
            

           
                <!-- Previous review cards -->
                <div class="review-card">
                    <div class="review-details">
                        <div class="review-header">
                            <span class="review-author">Saman Perera</span>
                            <span class="review-date">15/11/2024</span>
                        </div>
                        <div class="review-rating">
                            ★★★★★ (5/5)
                        </div>
                        <p class="review-content">
                            Great service! My pet received excellent care. 
                            Great service! My pet received excellent care. 
                            Great service! My pet received excellent care. 
                        </p>
                        <small>Appointment #6</small>
                    </div>
                    <div class="review-actions">
                        <button class="btn btn-reply" onclick="openReplyModal()">Reply</button>
                        <button class="btn btn-details" onclick="openDetailsModal()">View Details</button>
                    </div>
                </div>
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