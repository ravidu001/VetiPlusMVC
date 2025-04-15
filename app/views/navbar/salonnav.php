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
        // Get the current file name (without query parameters)
        $current_page = basename($_SERVER['PHP_SELF']);
        // Check if any of the appointment pages are active
        // $appointment_active = in_array($current_page, ['Newappointment.php', 'Cancelappointment.php', 'Completeappointment.php']);
        
    ?>

</head>
<body>
    
<div class="content">
        <nav id="sidebar" class="close">
            <ul>
                <div class="logocontent">
                    <img class="logo" src="<?= ROOT ?>/assets/images/common/logo.png" alt="logo">
                    <span class="logoname">VetiPlus<br></span>
                </div>
                <button onclick="toggleSidebar()" id="toggle-btn">
                    <i class="fa-solid fa-circle-chevron-left icon"></i>
                </button>  
                </li>
                <li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/Salon' ? 'active' : '' ?>">                        
                    <a href="<?= ROOT ?>/Salon">
                        <i class='bx bx-grid-alt icon'></i>
                        <span>Dashboard</span>
                    </a>
                </li>
              
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/SalonAppointments' ? 'active' : '' ?>"> 
                    <a href="<?=ROOT?>/SalonAppointments">
                        <i class="fa-regular fa-calendar-plus icon"></i></i>
                        <span>Appointments </span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonTimeSlot' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonTimeSlot">
                        <i class='bx bxs-pie-chart-alt icon'></i>
                        <span>Time Slot</span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonSlot' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonSlot">
                        <i class='bx bxs-pie-chart-alt icon'></i>
                        <span>Time SlotCreate</span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonService' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonService">
                        <i class='bx bxs-briefcase icon'></i>
                        <span>Services</span>
                    </a>
                </li>

                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonOffer' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonOffer">
                    <i class='bx bxs-offer icon'></i>
                        <span>Special Offers</span>
                    </a>
                </li>
            
                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonStaff' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonStaff">
                        <i class='bx bx-male-female icon'></i>
                        <span>Salon Team</span>
                    </a>
                </li>

                <li>

                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonFeedback' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonFeedback">
                        <i class='bx  bxs-message icon' ></i>
                        <span>Feedback</span>
                    </a>
                </li>


                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonContact' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonContact">
                        <i class='bx bxs-phone-call icon' ></i>
                        <span>Contact Us</span>
                    </a>
                </li>


                <li>
                <li class="nav-link <?= $current_page == '<?= ROOT?>/SalonProfile' ? 'active' : '' ?>"> 
                    <a href="<?= ROOT?>/SalonProfile">
                        <i class='bx bx-user icon'></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>

            <div class="bottomcontent">
                <ul>
                    <li>
                        <a href="<?= ROOT?>/Login">
                            <i class='bx bx-log-out icon'></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</body>
    <!-- <script src="<?=ROOT?>/assets/js/salon/sidebar.js"></script> -->
</html>


    

   