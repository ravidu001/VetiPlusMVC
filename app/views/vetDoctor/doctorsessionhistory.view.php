<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Session Management</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/newsession.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --body-color: #E4E9F7;
            --sidebar-color: #FFF;
            --primary-color: #6a0dad;
            --primary-color-light: #f6f5ff;
            --toggle-color: #ddd;
            --text-color: #707070;
            --background-light: #c8a2c8;
            --background-primary: #6a0dad;
            --background-white: #fff;
            --text-black: black;
            --text-primary: #6a0dad;
            --text-white: #fff;
            --shadow-color: rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: var(--body-color);
            transition: var(--transition);
        }

        .session-container {
            max-width: 1200px;
            margin: 20px auto;
            background: var(--background-white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px var(--shadow-color);
        }

        .session-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .session-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            background: var(--primary-color-light);
            padding: 20px;
            border-radius: 8px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .detail-value {
            background: var(--background-white);
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
        }

        .assistant-profile {
            display: flex;
            align-items: center;
            background: var(--primary-color-light);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .assistant-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
            border: 3px solid var(--primary-color);
        }

        .assistant-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .assistant-info {
            flex-grow: 1;
        }

        /* Star Rating Specific Styles */
        .rating-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .rating-stars {
            display: inline-flex;
            align-items: center;
            position: relative;
        }

        .rating-stars-background {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            color: #e0e0e0;
        }

        .rating-stars-foreground {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            overflow: hidden;
            color: var(--star-color);
        }

        .rating-stars i {
            font-size: 1.2rem;
            margin-right: 2px;
            color: var(--primary-color);
        }

        .rating-value {
            margin-left: 10px;
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.9rem;
        }

        .status-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-queue {
            background: var(--background-light);
            color: var(--text-white);
        }

        .btn-queue.active, .btn-queue:hover {
            background: var(--primary-color);
        }

        .appointment-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .appointment-table th {
            background: var(--primary-color);
            color: var(--text-white);
            padding: 15px;
            text-align: left;
        }

        .appointment-table td {
            background: var(--primary-color-light);
            padding: 15px;
            vertical-align: middle;
        }

        .appointment-table tbody tr {
            position: relative; /* Ensure the pseudo-element is positioned correctly */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Add transition for smooth animation */
        }

        .appointment-table tbody tr::before {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: var(--primary-color);
            transition: var(--transition);
            transition: width 0.3s ease;
        }

        .appointment-table tbody tr:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .appointment-table tbody tr:hover::before {
            width: 8px;
        }

        .table-actions {
            align-items: center;
            justify-content: center;
        }

        .table-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 5px;
        }

        .btn-complete {
            background: var(--primary-color);
            color: white;
            margin-right: 10px;
        }

        .btn-cancel {
            background: #f44336;
            color: white;
        }

        .table-btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        .pet-profile {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
        }

        .pet-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animated-section {
            animation: fadeIn 0.5s ease forwards;
        }

        .view-btn {
            position: relative; /* Required for the tooltip positioning */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--shadow-color);
            margin-bottom: 20px;
            color: var(--primary-color);
            transition: var(--transition);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .view-btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
            transform: scale(1.1) rotate(360deg);
            transition: var(--transition);
        }

        /* Custom tooltip styling */
        /* .view-btn:hover::after {
            content: attr(title);
            position: absolute;
            bottom: 100%; 
            left: 50%; */
            
            /* background-color: var(--primary-color);
            color: var(--white);
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none; 
        }*/
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="session-container">
        <a href="<?= ROOT ?>/DoctorViewSession/index" class="view-btn" title="Back">
            <i class='bx bx-left-arrow-circle'></i>
        </a>
        <div class="session-header">
            <h2>Veterinary Session Details</h2>
        </div>

        <div class="session-details">
            <div class="detail-item">
                <div class="detail-label">Start Date and Time</div>
                <div class="detail-value">2024-08-10, 15:00</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">End Date and Time</div>
                <div class="detail-value">2024-08-10, 17:00</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value">147, Galthude, Panadura</div>
            </div>
        </div>

        <div class="assistant-profile">
            <div class="assistant-avatar">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Assistant">
            </div>
            <div class="assistant-info">
                <h3>John Doe</h3>
                <p>Veterinary Assistant | 3 Years Experience</p>
                <div id="assistant-rating"></div>
                <div>Hourly Rate: $50/hr</div>
            </div>
        </div>

        <div class="session-container">
        <div class="status-buttons">
            <button class="btn btn-queue active" data-target="completed">Completed</button>
            <button class="btn btn-queue" data-target="cancelled">Cancelled</button>
        </div>

        <div id="completed" class="animated-section" >
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Owner Name</th>
                        <th>Pet Profile</th>
                        <th>Pet Details</th>
                        <th>Contact</th>
                        <th>Session Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>15:00</td>
                    </tr>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>15:30</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="cancelled" class="animated-section" style="display:none;">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Owner Name</th> <th>Pet Profile</th>
                        <th>Pet Details</th>
                        <th>Contact</th>
                        <th>Session Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>16:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script>
        const completeButtons = document.querySelectorAll('.btn-complete');
        const cancelButtons = document.querySelectorAll('.btn-cancel');
        const completedTableBody = document.querySelector('#completed tbody');
        const cancelledTableBody = document.querySelector('#cancelled tbody');

        // completeButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         const row = this.closest('tr');
        //         const ownerName = row.dataset.owner;
        //         const petImg = row.dataset.petImg;
        //         const petDetails = `${row.dataset.petName} (${row.dataset.petType}, ${row.dataset.petAge})`;
        //         const contact = row.dataset.contact;
        //         const session = row.dataset.session;

        //         const newRow = `<tr>
        //             <td>${ownerName}</td>
        //             <td>
        //                 <div class="pet-profile">
        //                     <img src="${petImg}" alt="Pet">
        //                 </div>
        //             </td>
        //             <td>${petDetails}</td>
        //             <td>${contact}</td>
        //             <td>${session}</td>
        //         </tr>`;
        //         completedTableBody.insertAdjacentHTML('beforeend', newRow);
        //         row.remove();
        //     });
        // });

        // cancelButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         const row = this.closest('tr');
        //         const ownerName = row.dataset.owner;
        //         const petImg = row.dataset.petImg;
        //         const petDetails = `${row.dataset.petName} (${row.dataset.petType}, ${row.dataset.petAge})`;
        //         const contact = row.dataset.contact;
        //         const session = row.dataset.session;

        //         const newRow = `<tr>
        //             <td>${ownerName}</td>
        //             <td>
        //                 <div class="pet-profile">
        //                     <img src="${petImg}" alt="Pet">
        //                 </div>
        //             </td>
        //             <td>${petDetails}</td>
        //             <td>${contact}</td>
        //             <td>${session}</td>
        //         </tr>`;
        //         cancelledTableBody.insertAdjacentHTML('beforeend', newRow);
        //         row.remove();
        //     });
        // });

        // document.querySelectorAll('.btn').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const target = this.dataset.target;
        //         document.querySelectorAll('.animated-section').forEach(section => {
        //             section.style.display = 'none';
        //         });
        //         document.getElementById(target).style.display = 'block';
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.status-buttons .btn');
            const sections = document.querySelectorAll('.animated-section');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    sections.forEach(section => {
                        section.style.display = section.id === target ? 'block' : 'none';
                    });
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        // Star Rating Class (from previous example)
        class StarRating {
            constructor(rating, options = {}) {
                this.rating = rating;
                this.options = {
                    maxStars: 5,
                    starColor: '#ffc107',
                    backgroundStarColor: '#e0e0e0',
                    size: 1.2,
                    // ...options
                };
            }

            renderStars() {
                const fullStars = Math.floor(this.rating);
                const decimalPart = this.rating % 1;

                let starsHTML = '';
                
                // Background (empty) stars
                for (let i = 0; i < this.options.maxStars; i++) {
                    starsHTML += `<i class="ri-star-line" style="color: ${this.options.backgroundStarColor}; font-size: ${this.options.size}rem;"></i>`;
                }

                // Foreground (filled) stars with precise width
                const filledWidth = `${(this.rating / this.options.maxStars) * 100}%`;
                
                return `
                    <div class="rating-container">
                        <div class="rating-stars">
                            <div class="rating-stars-background">
                                ${starsHTML}
                            </div>
                            <div class="rating-stars-foreground" style="width: ${filledWidth}">
                                ${starsHTML}
                            </div>
                        </div>
                        <span class="rating-value">${this.rating.toFixed(1)}</span>
                    </div>
                `;
            }

            static createDetailedStar(rating) {
                const fullStars = Math.floor(rating);
                // window.alert(fullStars);
                const decimalPart = rating % 1;
                // window.alert(decimalPart);

                let starsHTML = '';
                
                // Full stars
                for (let i = 0; i < fullStars; i++) {
                    starsHTML += '<i class="ri-star-fill"></i>';
                }

                // Partial star handling
                if (decimalPart > 0) {
                    starsHTML += `
                        <span class="star-detailed">
                            <span class="star-half">
                                <i class="ri-star-half-line"></i>
                            </span>
                        </span>
                    `;
                }

                // Remaining empty stars
                const remainingStars = 5 - Math.ceil(rating);
                for (let i = 0; i < remainingStars; i++) {
                    starsHTML += '<i class="ri-star-line"></i>';
                }

                return `
                    <div class="rating-container">
                        <div class="rating-stars">
                            ${starsHTML}
                        </div>
                        <span class="rating-value">${rating.toFixed(1)}</span>
                    </div>
                `;
            }
        }

        // Render Assistant Rating on Page Load
        document.addEventListener('DOMContentLoaded', () => {
            const assistantRatingContainer = document.getElementById('assistant-rating');
            
            // Method 1: Smooth Gradient Rendering
            // const smoothRating = new StarRating(4.5);
            // assistantRatingContainer.innerHTML = smoothRating.renderStars();

            // Optional: If you want to show both rendering methods
            const alternativeRatingContainer = document.createElement('div');
            const detailedRating = StarRating.createDetailedStar(3.5);
            alternativeRatingContainer.innerHTML = detailedRating;
            assistantRatingContainer.appendChild(alternativeRatingContainer);
        });

        // Additional Rating Rendering Examples
        // function renderMultipleRatings() {
        //     const ratings = [4.5, 4.2, 4.7, 3.8];
        //     const container = document.createElement('div');
            
        //     ratings.forEach(rating => {
        //         const ratingElement = document.createElement('div');
        //         const smoothRating = new StarRating(rating);
        //         ratingElement.innerHTML = smoothRating.renderStars();
        //         container.appendChild(ratingElement);
        //     });

        //     document.body.appendChild(container);
        // }
    </script>
</body>
</html>