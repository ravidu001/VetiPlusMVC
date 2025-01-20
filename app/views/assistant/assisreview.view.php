<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assistant Reviews</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/myreview.css">
</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-logo">
            <img src="<?= ROOT ?>/assets/images/vetDoctor/review.avif" alt="Veterinary Logo" class="loading-image">
        </div>
        <div class="loading-text" id="loadingMessage">
            Hey, Samantha! Fetching your reviews...🤩🤩🤩
        </div>
        <div id="reviewNotification">
    <div class="review-alert animated-bounce">
        <span class="emoji-icon">🐾</span>
        <div class="review-content">
            <h3>Woofderful Reviews Arrived!</h3>
            <p>3 Pet Parents Left Awesome Feedback</p>
            <div class="review-stats">
                <span>⭐ 4.8/5 Average Rating</span>
                <span>🏆 Top Rated Vet Clinic</span>
            </div>
        </div>
    </div>
</div>
        <p class="click-prompt">Click anywhere to continue</p>
    </div>
</div>

    <div class="main-content" id="mainContent">
        <?php require_once '../app/views/navbar/assistantnav.php'; ?>
        <div class="home">
        <div class="reviews-container">
            <!-- Previous review container HTML -->
            <div class="reviews-header">
                <h3 class="reviews-title">My Reviews</h3>
                <div class="filter-section">
                    <select class="filter-select">
                        <option>Sort by Date</option>
                        <option>Highest Rating</option>
                        <option>Lowest Rating</option>
                    </select>
                    <select class="filter-select">
                        <option>All Reviews</option>
                        <option>Unread</option>
                        <option>Replied</option>
                    </select>
                </div>
            </div>

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
    <script src="<?= ROOT ?>/assets/js/vetDoctor/myreview.js"></script>
</body>
</html>