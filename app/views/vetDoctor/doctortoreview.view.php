<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Assistant Reviews</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        .review-details {
            flex-grow: 1;
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
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-header">
            <h1>Vet Assistant Reviews</h1>
            <div class="review-tabs">
                <button class="tab-button active" onclick="switchTab('pending')">Pending Reviews</button>
                <button class="tab-button" onclick="switchTab('completed')">Completed Reviews</ button>
            </div>
        </div>

        <div id="pendingReviews" class="review-grid">
            <!-- Pending Review Cards -->
            <div class="review-card">
                <div class="assistant-profile">
                    <img src="https://randomuser.me/api/portraits/women/50.jpg" alt="Assistant Profile">
                    <div>
                        <h3>Emma Johnson</h3>
                        <p>Appointment: Aug 17, 2024</p>
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
                    <div>
                        <h3>Michael Chen</h3>
                        <p>Appointment: Aug 19, 2024</p>
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
                    <div>
                        <h3>Sarah Williams</h3>
                        <p>Appointment: Aug 10, 2024</p>
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
        <div class="modal-content">
            <h2>Review Vet Assistant</h2>
            <!-- Add review form here -->
        </div>
    </div>

    <script>
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
            } else {
                pendingTab.style.display = 'none';
                completedTab.style.display = 'grid';
                pendingButton.classList.remove('active');
                completedButton.classList.add('active');
            }
        }

        function openReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.style.display = 'flex';
        }

        function deleteReview(button) {
            const card = button.closest('.review-card');
            card.remove();
        }

        window.onclick = function(event) {
            const modal = document.getElementById('reviewModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>