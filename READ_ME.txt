VetDoctor
update doctorreview.view page 
    view-alter class content is hard coded and it should be remove after backend is done.
    relevant js file 1-54 line shuld be un comment and add relavent url here (fetch(''))
    @394 line in css file /* remove after new code added to the reviewNotification section */

    not full complete certificate.view.php file that is about medical certificate

    <script>
        const sessionDates = ['2024-11-15', '2024-12-16', '2025-01-20'];
        // this will pass the session dates to calendar for highlighting relevant dates
    </script>



Vet Assistant


Calendar
    remove funtions from existing js code
    1.Add a Global Variable in DoctorViewSession.php:
    <script>
    const isDoctorViewSession = true;
    </script>

    2.Modify the selectDate Function: Update calendar.js to check for this flag before running:
    selectDate(date, element) {
        if (typeof isDoctorViewSession !== 'undefined' && isDoctorViewSession) {
            // Do nothing in DoctorViewSession
            return;
        }

        // Prevent selection of past dates
        if (date < new Date()) return;

        // Remove previous selection
        this.calendarGrid.querySelectorAll('.calendar-day').forEach(el => 
            el.classList.remove('selected')
        );

        // Add selection to clicked date
        element.classList.add('selected');

        // Update selected date input
        this.selectedDateInput.value = date.toDateString();
    }





this is the page about vet doctor can review their vet assistants after assistants attend to the appointment session.

this is the html file
```

```

this is the css file 
```

```

this is js file
```

```

this is not a good UI experience for the vet doctors(users). So I need to make this more user friendly and attractive with the modern style with some animations too.

apart from this there is a sidebar which can be open and close. when it is open 250px and 88px used when close. home class includes

```
.home {
   position: relative;
   left: 250px;
   height: 100vh;
   width: calc(100% - 250px);
   background: var(--body-color);
   transition: var(--tran-05);
}

.home .text {
   font-size: 24px;
   font-weight: 500;
   color: var(--text-color);
   padding: 8px 40px;
}

.sidebar.close ~ .home {
   left: 88px;
   width: calc(100% - 88px);
}
```

this is my web page root color code
```
:root{
   --body-color: #E4E9F7;
   --sidebar-color: #FFF;
   --primary-color: #6a0dad;
   --primary-color-light: #f6f5ff;
   --toggle-color: #ddd;
   --text-color: #707070;
   --background-light: #c8a2c8;
   --background-primary: #6a0dad ;
   --background-white: #fff;
   --text-black: black;
   --text-primary: #6a0dad;
   --text-white: #fff;
   --shadow-color: slategray;
   --list-item: #ffecff;
 
   
   --tran-02: all 0.2s ease;
   --tran-03: all 0.3s ease;
   --tran-04: all 0.4s ease;
   --tran-05: all 0.5s ease;
}
```


Give me a single code without break down. I need single file. Give me best one. Don't forget I am still only UI interfaces that means I did not have still backend. So, I need hard coded output to see how UI is look likes






this is my old vet assistant page for 

this is the html file
```

```

this is the css file 
```

```

this is js file
```

```

this is not a good UI experience for the vet assistant(users). So I need to make this similar to below page. refer that page carefully and give me a best user friendly and modern UI for the vet doctor.
if you feel new features to add vet assitant apart from old page.please feel free to add them also. 

Give me a single code without break down. I need single file. Give me best one. Don't forget I am still only UI interfaces that means I did not have still backend. So, I need hard coded output to see how UI is look likes


apart from this there is a sidebar which can be open and close. when it is open 250px and 88px used when close. home class includes

```
.home {
   position: relative;
   left: 250px;
   height: 100vh;
   width: calc(100% - 250px);
   background: var(--body-color);
   transition: var(--tran-05);
}

.home .text {
   font-size: 24px;
   font-weight: 500;
   color: var(--text-color);
   padding: 8px 40px;
}

.sidebar.close ~ .home {
   left: 88px;
   width: calc(100% - 88px);
}
```

this is my web page root color code
```
:root{
   --body-color: #E4E9F7;
   --sidebar-color: #FFF;
   --primary-color: #6a0dad;
   --primary-color-light: #f6f5ff;
   --toggle-color: #ddd;
   --text-color: #707070;
   --background-light: #c8a2c8;
   --background-primary: #6a0dad ;
   --background-white: #fff;
   --text-black: black;
   --text-primary: #6a0dad;
   --text-white: #fff;
   --shadow-color: slategray;
   --list-item: #ffecff;
 
   
   --tran-02: all 0.2s ease;
   --tran-03: all 0.3s ease;
   --tran-04: all 0.4s ease;
   --tran-05: all 0.5s ease;
}
```


below page that you have to refer
this is the html file
```

```

this is the css file 
```

```

this is js file
```

```




// assitant request page
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vet Assistant Appointment Requests</title>
    <style>
        :root {
            --body-color: #E4E9F7;
            --primary-color: #6a0dad;
            --secondary-color: #c8a2c8;
            --white: #ffffff;
            --text-color: #333;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--body-color);
            display: flex;
        }

        .home {
            width: calc(100% - 250px);
            margin-left: 250px;
            padding: 20px;
            transition: var(--transition);
        }

        .request-container {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .request-header h2 {
            color: var(--primary-color);
            font-size: 24px;
        }

        .request-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .request-table th {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 15px;
            text-align: left;
        }

        .request-table tr {
            background-color: #f9f5ff;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .request-table tr:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .request-table td {
            padding: 15px;
            vertical-align: middle;
        }

        .doctor-profile {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }

        .btn-accept {
            background-color: #4caf50;
            color: white;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .request-table tr {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="home">
        <div class="request-container">
            <div class="request-header">
                <h2>Appointment Requests</h2>
                <div class="filter-options">
                    <!-- Optional: Add filter/sort functionality -->
                </div>
            </div>
            <table class="request-table">
                <thead>
                    <tr>
                        <th colspan="2" class="table-heading">Doctor</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="Dr. Kasun" class="doctor-profile">
                            
                        </td>
                        <td>Dr. Kasun Perera</td>
                        <td>Nov 30, 2024<br>3:00 PM - 6:00 PM</td>
                        <td>147, Galthude, Panadura</td>
                        <td>077 050 7520</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-accept">Accept</button>
                                <button class="btn btn-reject">Reject</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="Dr. Saman" class="doctor-profile">
                            
                        </td>
                        <td>Dr. Saman Silva</td>
                        <td>Dec 02, 2024<br>3:00 PM - 6:00 PM</td>
                        <td>147, Hirana, Panadura</td>
                        <td>077 050 1136</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-accept">Accept</button>
                                <button class="btn btn-reject">Reject</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Future JavaScript for dynamic interactions
        document.querySelectorAll('.btn-accept, .btn-reject').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                row.remove(); // Simple removal for now
                // In future: Add logic to move to appropriate sections
            });
        });
    </script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Assistant Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/myreview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* Root Variables and Base Styles (Similar to previous implementations) */
        :root {
            --body-color: #E4E9F7;
            --primary-color: #6a0dad;
            --secondary-color: #8E44AD;
            --white-color: #FFFFFF;
            --text-color: #333;
            --light-text: #666;
            --border-color: #E0E0E0;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--body-color);
            line-height: 1.6;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 20px;
            border-radius: 12px;
            color: white;
            box-shadow: 0 10px 30px rgba(106, 13, 173, 0.2);
            margin-bottom: 20px;
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

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white-color);
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
            color: var(--text-color);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--light-text);
        }

        /* Doctor Requests Table */
        .doctor-requests {
            background: var(--white-color);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .doctor-requests table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .doctor-requests thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .doctor-requests th, .doctor-requests td {
            padding: 15px;
            text-align: left;
        }

        .doctor-requests tbody tr {
            background-color: #f9f9f9;
            transition: var(--transition);
        }

        .doctor-requests tbody tr:hover {
            background-color: var(--border-color);
            transform: translateY(-5px);
        }

        .view-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .view-button:hover {
            background-color: var(--secondary-color);
        }

        /* Reviews Section */
        .reviews-section {
            background: var(--white-color);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .review-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .review-details {
            flex-grow: 1;
        }

        .review-action {
            display: flex;
            gap: 10px;
        }

        .reply-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .reply-button:hover {
            background-color: var(--secondary-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .home {
                left: 88px;
                width: calc(100% - 88px);
            }
        }


        .modal {
            backdrop-filter: none !important; /* Override the external CSS */
            background-color: rgba(0, 0, 0, 0);
            overflow: auto !important; 
        }

        .reviews-container {
            padding:10px;
            margin-bottom:0;
        }

        .reviews-container h2 {
            margin-bottom: 20px;
        }

        body {
    overflow-y: scroll !important;
}

.home {
    height: auto !important;
    min-height: 100vh;
    overflow-y: auto !important;
}

.dashboard-container {
    overflow-y: auto;
    height: auto;
}

html, body {
    overflow: auto !important;
    overflow-y: scroll !important;
    height: 100% !important;
    max-height: 100% !important;
}

.home {
    overflow-y: auto !important;
    height: auto !important;
    max-height: none !important;
}

body {
    position: static !important;
    overscroll-behavior: auto !important;
}
    </style>
</head>
<body>
    <div class="home">
        <div class="dashboard-container">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-avatar">
                    <img src="../../../client/assets/images/assistantprofile.avif" alt="Profile">
                </div>
                <div>
                    <h1>Dr. Kasun Perera</h1>
                    <p>Veterinary Assistant | 3 Years Experience</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-card">
                    <i class="ri-calendar-check-line stat-icon"></i>
                    <div class="stat-content">
                        <div class="stat-number">15</div>
                        <div class="stat-label">Total Requests</div>
                    </div>
                </div>
                 <div class="stat-card">
                    <i class="ri-paw-line stat-icon"></i>
                    <div class="stat-content">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Active Cases</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="ri-star-line stat-icon"></i>
                    <div class="stat-content">
                        <div class="stat-number">120</div>
                        <div class="stat-label">Total Reviews</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="ri-message-3-line stat-icon"></i>
                    <div class="stat-content">
                        <div class="stat-number">5</div>
                        <div class="stat-label">New Messages</div>
                    </div>
                </div>
            </div>

            <!-- Doctor Requests Table -->
            <div class="doctor-requests">
                <h2>Doctor Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Pet Name</th>
                            <th>Owner Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Buddy</td>
                            <td>John Doe</td>
                            <td>2023-10-01</td>
                            <td>Pending</td>
                            <td><button class="view-button">View</button></td>
                        </tr>
                        <tr>
                            <td>Max</td>
                            <td>Jane Smith</td>
                            <td>2023-10-02</td>
                            <td>Completed</td>
                            <td><button class="view-button">View</button></td>
                        </tr>
                        <tr>
                            <td>Charlie</td>
                            <td>Emily Johnson</td>
                            <td>2023-10-03</td>
                            <td>In Progress</td>
                            <td><button class="view-button">View</button></td>
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
    </div>
    <script>
        // JavaScript for interactive elements can be added here
        document.querySelectorAll('.view-button').forEach(button => {
            button.addEventListener('click', () => {
                alert('Viewing details for the selected request.');
            });
        });

        document.querySelectorAll('.reply-button').forEach(button => {
            button.addEventListener('click', () => {
                alert('Replying to the review.');
            });
        });

        
    // Add this at the end of your body tag
    window.addEventListener('load', () => {
        console.log('Document height:', document.documentElement.scrollHeight);
        console.log('Window height:', window.innerHeight);
        console.log('Body overflow:', window.getComputedStyle(document.body).overflow);
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Forcibly remove any scroll prevention
        document.body.style.overflow = 'auto';
        document.documentElement.style.overflow = 'auto';
        
        // Ensure scrolling is possible
        window.addEventListener('wheel', (e) => {
            e.stopPropagation();
        }, { passive: true });

        // Diagnostic logging
        console.log('Body overflow after fix:', window.getComputedStyle(document.body).overflow);
        console.log('HTML overflow after fix:', window.getComputedStyle(document.documentElement).overflow);
    });
</script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vet Sessions Scheduler</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/viewsession.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="container">
        <?php require_once '../app/views/calendar.view.php'; ?>
        <!-- <div class="calendar-section">
            <div class="calendar-header">
                <h2 id="current-month">August 2024</h2>
                <div class="calendar-navigation">
                    <button>←</button>
                    <button>→</button>
                </div>
            </div>
            <div id="calendar-grid" class="calendar-grid">
                Calendar Days Generated Here
            </div>
        </div> -->

        <h2 class="session-heading">Upcoming Sessions</h2>
        <table class="sessions-table">
    <thead>
        <tr>
            <th>Session</th>
            <th>Assistant</th>
            <th>Date & Time</th>
            <th>Location</th>
            <th>Appointments</th>
            <!-- <th>Status</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($session as $session): ?>
        <tr>
            <td><?= htmlspecialchars($session->sessionID) ?></td>
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
            <?= htmlspecialchars($session->selectedDate) ?><br>
        <?php
        $startTime = new DateTime($session->startTime);
        $endTime = new DateTime($session->endTime);
        ?>
        <?= $startTime->format('H:i') ?> - <?= $endTime->format('H:i') ?>
            </td>
            <td><?= htmlspecialchars($session->clinicLocation) ?></td>
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
        <?php endforeach; ?>
        <!-- <tr>
            <td>002</td>
            <td>
                <div class="vet-info">
                    <div class="vet-avatar">
                        <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="assistant">
                    </div>
                    <div class="vet-details">
                        <span class="vet-name">Dr. Emily Wong</span>
                        <span class="vet-specialization">Exotic Pets</span>
                    </div>
                </div>
            </td>
            <td>
                2025/01/16<br>
                15:00 - 17:00
            </td>
            <td>22, Main Street, Colombo</td>
            <td>8</td>
            <td>
                <a href="<?= ROOT ?>/DoctorViewSession/session" class="view-btn">
                    <i class='bx bx-right-arrow-circle'></i>
                </a>
            </td>
        </tr> -->
    </tbody>
</table>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/calendar/calendar.js"></script>
    <script>
        const sessionDates = ['2024-11-15', '2024-12-16', '2025-01-20'];
        // this will pass the session dates to calendar for highlighting relevant dates

        const isActiveDate = true;
    
    </script>
        
</body>
</html>


hello ramesh 