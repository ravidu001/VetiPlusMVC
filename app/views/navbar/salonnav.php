<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
    <script type="text/javascript" src="<?=ROOT?>/assets/js/navbar/salonnav.js" defer></script>

    <?php
        
        $current_page = basename($_SERVER['PHP_SELF']);
        
        $salonID = $_SESSION['SALON_USER'];

        if(empty($salonID))
        {
            redirect('Login/login');
        }

    ?>

</head>
<body>
    
<div class="content">
        <nav id="sidebar" class="close">
            <ul>
                <div class="logocontent">
                    <img class="logo" src="<?= ROOT ?>/assets/images/common/logo.png" alt="logo">
                    <span class="logoname">VetiPlus<br>Salon</span><br>
                </div>
                <button onclick="toggleSidebar()" id="toggle-btn">
                    <i class="fa-solid fa-circle-chevron-left icon"></i>
                </button>  
                </li>
                <li>
                <li class="nav-link <?= $current_page == 'Salon' ? 'active' : '' ?>">                        
                    <a href="<?= ROOT ?>/Salon">
                        <i class='bx bx-grid-alt icon'></i>
                        <span>Dashboard</span>
                    </a>
                </li>
              
                <li class="nav-link <?= $current_page == 'SalonAppointments' ? 'active' : '' ?>"> 
                    <a href="<?=ROOT?>/SalonAppointments">
                        <i class="fa-regular fa-calendar-plus icon"></i></i>
                        <span>Appointments </span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == 'SalonTimeSlot' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonTimeSlot">
                        <i class='bx bxs-pie-chart-alt icon'></i>
                        <span>Time Slot</span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == 'SalonService' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonService">
                        <i class='bx bxs-briefcase icon'></i>
                        <span>Services</span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == 'SalonOffer' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonOffer">
                    <i class='bx bxs-offer icon'></i>
                        <span>Special Offers</span>
                    </a>
                </li>
            
                <li class="nav-link <?= $current_page == 'SalonStaff' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonStaff">
                        <i class='bx bx-male-female icon'></i>
                        <span>Salon Team</span>
                    </a>
                </li>

                <li>

                <li class="nav-link <?= $current_page == 'SalonFeedback' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonFeedback">
                        <i class='bx  bxs-message icon' ></i>
                        <span>Feedback</span>
                    </a>
                </li>


                <li class="nav-link <?= $current_page == 'SalonContact' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonContact">
                        <i class='bx bxs-phone-call icon' ></i>
                        <span>Contact Us</span>
                    </a>
                </li>


                <li>
                <li class="nav-link <?= $current_page == 'SalonProfile' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonProfile">
                        <i class='bx bx-user icon'></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>

            <div class="bottomcontent">
                <ul>
                    <li>
                        <a href="<?= ROOT?>/LogOut">
                            <i class='bx bx-log-out icon'></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</body>
   
</html>


    

   