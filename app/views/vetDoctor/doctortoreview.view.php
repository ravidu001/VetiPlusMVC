<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Assistant Reviews</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6a0dad;
            --background-light: #f5f0f9;
            --text-color: #333;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-color);
        }

        .review-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .review-tabs {
            display: flex;
            gap: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            background-color: var(--white);
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            color: var(--primary-color);
            cursor: pointer;
            transition: var(--transition);
            font-weight: bold;
        }

        .tab-button.active {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .review-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .review-card {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 25px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.15);
        }

        .assistant-profile {
            display: flex;
            align-items: center;
            margin-right: 30px;
        }

        .assistant-profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .assistant-details h3 {
            padding-bottom: 10px;
        }

        .review-details {
            flex-grow: 1;
           padding-left:20px;
        }

        .review-details p {
            padding: 8px;
        }

        .review-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .review-rating {
            display: flex;
            color: #ffc107;
            font-size: 24px;
        }

        .review-button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .review-button:hover {
            opacity: 0.9;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .delete-button {
            background-color: red;
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }
       
        .delete-button:hover {
            opacity: 0.8;
        }

        .feedback-modal {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            width: 500px;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transform: perspective(1000px) rotateX(-10deg);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .feedback-modal.active {
            transform: perspective(1000px) rotateX(0);
            opacity: 1;
        }

        .modal-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #e6e6e6;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        /* .rating-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        } */

        /* .rating-star {
            font-size: 40px;
            color: #e0e0e0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .rating-star:hover,
        .rating-star.active {
            color: #ffc107;
            transform: scale(1.2);
        } */

        /* rating section */
        .rating {
            width: 400px;
            background: none;
            padding: 10px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .rating .star-widget input {
            display: none;
        }

        .star-widget label {
            font-size: 40px;
            color: #444; 
            padding: 10px;
            float: right;
            transition: all 0.2s ease;
        }

        .star-widget input:not(:checked) ~ label:hover,
        .star-widget input:not(:checked) ~ label:hover ~ label {
            color: var(--text-primary);
        }

        .star-widget input:checked ~ label {
            color: var(--text-primary);
        }

        input#rate-5:checked ~ label {
            color: var(--text-primary);
            text-shadow: 0 0 20px var(--background-light);
        }

        /* Display rating text based on selection */
        #rate-1:checked ~ header:before {
            content: 'Very Bad 😖';
        } 
        #rate-2:checked ~ header:before {
            content: 'Bad 🙁';
        }
        #rate-3:checked ~ header:before {
            content: 'Good 😃';
        }
        #rate-4:checked ~ header:before {
            content: 'Very Good 😎';
        }
        #rate-5:checked ~ header:before {
            content: "Excellent 😍";
        }

        star-widget header {
            display: none;
        }

        input:checked ~ header {
            display: block;
        }

        .star-widget header {
            width: 100%;
            font-size: 25px;
            color: var(--text-primary);
            font-weight: 500;
            margin: 5px 0 20px 0;
            text-align: center;
            transition: all 0.2s ease;
        } 

        .feedback-textarea {
            width: 100%;
            height: 150px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            resize: none;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .feedback-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            flex: 1;
            padding: 12px;
            margin: 0 10px;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-cancel {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: scale(0.7);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
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

    <script>
        let currentTab = 'pending'; // Default tab

        function switchTab(tab) {
            const pendingTab = document.getElementById('pendingReviews');
            const completedTab = document.getElementById('completedReviews');
            const pendingButton = document.querySelector('.tab-button:nth-child(1)');
            const completedButton = document.querySelector('.tab-button:nth-child(2)');

            if (tab === 'pending') {
                pendingTab.style.display = 'grid';
                completedTab.style.display = 'none';
                pendingButton.classList.add('active');
                completedButton.classList.remove('active');
                currentTab = 'pending';
                // window.alert(currentTab);
            } else {
                pendingTab.style.display = 'none';
                completedTab.style.display = 'grid';
                pendingButton.classList.remove('active');
                completedButton.classList.add('active');
                currentTab = 'completed';
                // window.alert(currentTab);
            }
        }

        function openReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.style.display = 'flex';
        }

        function closeModal() {
            const modal = document.getElementById('reviewModal');
            modal.style.display = 'none';
            switchTab(currentTab); // Switch back to the relevant tab
        }

        function deleteReview(button) {
            const card = button.closest('.review-card');
            // Add your delete logic here
        }

        // Add event listener to the cancel button
        document.getElementById('cancel').addEventListener('click', closeModal);
        

    </script>
</body>
</html>