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
            <div class="review-card">
                <div class="assistant-profile">
                    <img src="https://randomuser.me/api/portraits/women/50.jpg" alt="Assistant Profile">
                    <div class="assistant-details">
                        <h3>Emma Johnson</h3>
                        <p>Session: Aug 17, 2024</p>
                    </div>
                </div>
                <div class="review-details">
                    <p>Location: 147 Galthude, Panadura</p>
                    <p>Time: 3:00 PM - 5:00 PM</p>
                </div>
                <div class="review-actions">
                    <button class="review-button" onclick="openReviewModal()">Review</button>
                </div>
            </div>

            <div class="review-card">
                <div class="assistant-profile">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Assistant Profile">
                    <div class="assistant-details">
                        <h3>Michael Chen</h3>
                        <p>Session: Aug 19, 2024</p>
                    </div>
                </div>
                <div class="review-details">
                    <p>Location: 150 Galthude, Colombo</p>
                    <p>Time: 2:00 PM - 4:00 PM</p>
                </div>
                <div class="review-actions">
                    <button class="review-button" onclick="openReviewModal()">Review</button>
                </div>
            </div>
        </div>

        <div id="completedReviews" class="review-grid" style="display: none;">
            <!-- Completed Review Cards -->
            <div class="review-card">
                <div class="assistant-profile">
                    <img src="https://randomuser.me/api/portraits/women/60.jpg" alt="Assistant Profile">
                    <div class="assistant-details">
                        <h3>Sarah Williams</h3>
                        <p>Session: Aug 10, 2024</p>
                    </div>
                </div>
                <div class="review-details">
                    <p>Your Review: Excellent work and professional attitude</p>
                    <div class="review-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                </div>
                <div class="review-actions">
                    <button class="review-button" onclick="openReviewModal()">Edit</button>
                    <button class="delete-button" onclick="deleteReview(this)">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div id="reviewModal" class="modal">
        <!-- <div class="modal-content">
            <h2>Review Vet Assistant</h2> -->
            <!-- Add review form here -->
        <!-- </div> -->
        <form method="post" action="#">
            <div class="feedback-modal active">
                <div class="modal-header">
                    <img src="https://randomuser.me/api/portraits/women/50.jpg" alt="Profile" class="profile-image">
                    <h2 class="modal-title">Provide Feedback</h2>
                </div>

                <div class="rating">
                    <div class="star-widget"> 
                        <input type="radio" name="rate" id="rate-5">
                        <label for="rate-5" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-4">
                        <label for="rate-4" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-3">
                        <label for="rate-3" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-2">
                        <label for="rate-2" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-1">
                        <label for="rate-1" class="fas fa-star"></label>
                        
                        <header> </header>

                    </div>
                </div>

                <textarea class="feedback-textarea" placeholder="Share your detailed feedback here..."></textarea>

                <div class="button-group">
                    <button class="btn btn-cancel" id="cancel">Cancel</button>
                    <button class="btn btn-submit">Submit Feedback</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/vetDoctor/toreview.js"></script>
</body>
</html>