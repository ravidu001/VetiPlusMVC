<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinarian Reviews</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/jsnotification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/myreview.css">
</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-logo">
            <img src="<?= ROOT ?>/assets/images/vetDoctor/review.avif" alt="Veterinary Logo" class="loading-image">
        </div>
        <div class="loading-text" id="loadingMessage">
            Hey, Dr. <?= htmlspecialchars($doctorName ?? '', ENT_QUOTES, 'UTF-8') ?>! Fetching your reviews...🤩🤩🤩
        </div>
        <div id="reviewNotification">
            <div class="review-alert animated-bounce">
                <span class="emoji-icon">🐾</span>
                <div class="review-content">
                    <h3>Woofderful Reviews Arrived!</h3>
                    <p><?= $unreadCount ?? 0 ?> Pet Parents Left Awesome Feedback</p>
                    <div class="review-stats">
                        <span>⭐ <?= $averageRating ?? 0 ?>/5 Average Rating</span>
                        <span>
                            <?php
                            if ($averageRating >= 4) {
                                echo '🏆 Top Rated Vet Doctor! Keep shining!';
                            } elseif ($averageRating >= 3) {
                                echo '🌟 Good job! You\'re on the right path!';
                            } elseif ($averageRating >= 2) {
                                echo '😊 Room for improvement! Engage with clients!';
                            } elseif ($averageRating >= 1) {
                                echo '⚠️ Below average. Let\'s work on this!';
                            } elseif ($averageRating > 0) {
                                echo '🔍 Every review counts! Aim higher!';
                            } else {
                                echo '❓ No ratings yet. Start gathering feedback!';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <p class="click-prompt">Click anywhere to continue</p>
    </div>
</div>

    <div class="main-content" id="mainContent">
        <?php require_once '../app/views/navbar/doctornav.php'; ?>
        <div class="home">
        <div class="reviews-container">
            <!-- Previous review container HTML -->
            <div class="reviews-header">
                <h3 class="reviews-title">My Reviews</h3>
                <div class="filter-section">
                    <div class="filter-section">
                        <select class="filter-select" id="sortSelect">
                            <option value="date">Sort by Date</option>
                            <option value="highestRating">Highest Rating</option>
                            <option value="lowestRating">Lowest Rating</option>
                        </select>
                    </div>
                    <select class="filter-select" id="statusSelect">
                        <option value="all">All Reviews</option>
                        <option value="unread">Unread</option>
                        <option value="replied">Replied</option>
                    </select>
                </div>
            </div>
            <?php if (!empty($reviews)): ?>
                <!-- <p>  reviews available</p> -->
            <?php else: ?>
                <p>  No reviews available</p>
            <?php endif; ?>
            <div class="review-fullcard">
                <?php foreach ($reviews as $review): ?>
                    <div class="review-card" style="margin-bottom: 15px;">
                        <div class="review-details">
                            <div class="review-header">
                                <span class="review-author"><?= $review['petOwner']->fullName ?></span>
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
                            <small>Appointment #<?= $review['reviewData']->appointmentID ?></small>
                        </div>
                        <div class="review-actions">
                            <?php if ($review['reviewData']->status): ?>
                                <!-- <span class="review-responded">Replied</span> -->
                                <button class="btn btn-details" 
                                        onclick="openDetailsModal(
                                        '<?= htmlspecialchars($review['petOwner']->fullName) ?>', 
                                        '<?= htmlspecialchars($formattedDate) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->rating) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->comment) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->appointmentID) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->respond) ?>'
                                    )">
                                    View Details
                                </button>
                            <?php else: ?>
                            <button class="btn btn-reply" onclick="openReplyModal('<?= htmlspecialchars($review['reviewData']->feedbackID) ?>')">Reply</button>
                            <button class="btn btn-details" 
                                    onclick="openDetailsModal(
                                        '<?= htmlspecialchars($review['petOwner']->fullName) ?>', 
                                        '<?= htmlspecialchars($formattedDate) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->rating) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->comment) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->appointmentID) ?>', 
                                        '<?= htmlspecialchars($review['reviewData']->respond) ?>'
                                    )">
                                View Details
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
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
                <input type="hidden" id="feedbackID" /> <!-- Hidden input for feedbackID -->
                <textarea 
                    id="replyTextarea" 
                    class="reply-textarea" 
                    placeholder="Write your professional and compassionate response here..."
                    maxlength="500"
                    oninput="updateCharCount(this)"
                    required
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
                    <span class="review-detail-value" data-label="reviewer"></span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Date</span>
                    <span class="review-detail-value" data-label="date"></span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Rating</span>
                    <span class="review-detail-value" data-label="rating"></span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Content</span>
                    <span class="review-detail-value" data-label="content"></span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Appointment ID</span>
                    <span class="review-detail-value" data-label="appointmentID"></span>
                </div>
                <div class="review-detail-item">
                    <span class="review-detail-label">Response</span>
                    <span class="review-detail-value" data-label="response"></span>
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
    <script>
        const reviews = <?= json_encode($reviews) ?>; // Pass PHP reviews to JavaScript
    </script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/jsnotification.js"></script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/myreview.js"></script>
</body>
</html>