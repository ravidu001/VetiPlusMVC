<?php
// Get the current file name (without query parameters)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?= ROOT ?>/assets/images/common/logo.png" alt="logo">
            </span>

            <div class="text header-text">
                <span class="name">VetiPlus</span>
                <span class="profession">Pet Care</span>
            </div>
        </div>
        <div class="text header-text">
            <div class="type"> System Admin</div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <h4>Main Menu</h4>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/Admin/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/Admin/index">
                        <i class='bx bx-home icon'></i>
                        <span class="text nav-text">Dashbord</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminAccountDashboard/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminAccountDashboard/index">
                        <i class='bx bx-group icon'></i>
                        <span class="text nav-text"> Account</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminAppointment/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminAppointment/index">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text"> Appointment</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminPayment/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminPayment/index">
                        <i class='bx bx-dollar icon'></i>
                        <span class="text nav-text">Payment</span>
                    </a>
                </li>
                <h4>Other Menu</h4>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminFeedback/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminFeedback/index">
                        <i class='bx bx-message-dots icon'></i>
                        <span class="text nav-text">Feedback</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminComplain/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminComplain/index">
                        <i class='bx bx-shield-quarter icon'></i>
                        <span class="text nav-text">Complain</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminAddData/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminAddData/index">
                        <i class='bx bx-plus-medical icon'></i>
                        <span class="text nav-text">Add Species</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminVaccineData/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AdminVaccineData/index">
                        <i class='bx bx-plus-medical icon'></i>
                        <span class="text nav-text">Add Vaccine</span>
                    </a>
                </li>
                <li class="nav-link" style="display:block">
                    <a href="#" class="appointment-link">
                        <i class='bx bx-cog icon'></i>
                        <span class="text nav-text">System</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <!-- Sub-menu should be inside the parent li -->

                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminSalonSystem/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AdminSalonSystem/index">
                                <i class='bx bx-home-heart icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Salon System</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminDoctorSystem/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AdminDoctorSystem/index">
                                <i class='bx bx-plus-medical icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Doctor System</span>
                            </a>
                        </li>
                    </ul>

                </li>
                <div style="display:none;" id="hiddenListItems-Appointment">
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                </div>
            </ul>
        </div>

        <div class="bottom-content">
            <li class="nav-link <?= $current_page == '<?= ROOT ?>/AdminProfile/index' ? 'active' : '' ?>">
                <a href="<?= ROOT ?>/AdminProfile/index">
                    <div class="profile">
                        <img src="../../assets/images/image_8.jpg" alt="">
                    </div>
                    <span class="text nav-text"> Profile</span>
                </a>
            </li>

            <li class="mode">
                <div class="moon-sun">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>

<script src="<?= ROOT ?>/assets/js/navbar/darkmode.js"></script>
<script src="<?= ROOT ?>/assets/js/navbar/adminnav.js"></script>