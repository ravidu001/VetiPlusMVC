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

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <li class="search-box">
                <i class='bx bx-search-alt-2 icon'></i>
                <input type="text" placeholder="Search...">
            </li>

            <ul class="menu-links">
                <li class="nav-link <?= $current_page == 'homeNew.php' ? 'active' : '' ?>">
                    <a href="homeNew.php">
                        <i class='bx bx-home icon'></i>
                        <span class="text nav-text"> Home</span>
                    </a>
                </li>
                <li class="nav-link" style="display:block">
                    <a href="appointment.php" class="appointment-link">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text">Appointment</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <!-- Sub-menu should be inside the parent li -->

                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorNewSession/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorNewSession/index">
                                <i class='bx bx-calendar-plus icon'></i>
                                <span class="text nav-text" style="font-size:14px;">New Session</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/doctorviewsession/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/doctorviewsession/index">
                                <i class='bx bx-calendar-event icon'></i>
                                <span class="text nav-text" style="font-size:14px;">View Sessions</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == 'historyAppointment.php' ? 'active' : '' ?>">
                            <a href="historyAppointment.php">
                                <i class='bx bx-calendar-check icon'></i>
                                <span class="text nav-text" style="font-size:14px;"> History</span>
                            </a>
                        </li>
                    </ul>

                </li>

                <div style="display:none;" id="hiddenListItems-Appointment">
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                </div>

                <li class="nav-link" style="display:block">
                    <a href="#" class="Medical-link">
                        <i class='bx bx-plus-medical icon'></i>
                        <span class="text nav-text"> Medical</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorPrescription/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorPrescription/index">
                                <i class='bx bx-book-add icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Add Prescription</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorMedicalHistory/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorMedicalHistory/index">
                                <i class='bx bx-history icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Medical History</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorCertificate/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorCertificate/index">
                                <i class='bx bx-certification icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Create Certificate</span>
                            </a>
                        </li>
                    </ul>

                </li>

                <div style="display:none;" id="hiddenListItems-Medical">
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                </div>

                <li class="nav-link" style="display:block">
                    <a href="#" class="Review-link">
                        <i class='bx bx-message-rounded-dots icon'></i>
                        <span class="text nav-text"> Feedback</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorReview/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorReview/index">
                                <i class='bx bx-smile icon'></i>
                                <span class="text nav-text" style="font-size:14px;">My Reviews</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorToreview/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorToreview/index">
                                <i class='bx bx-upside-down icon'></i>
                                <span class="text nav-text" style="font-size:14px;">To Review</span>
                            </a>
                        </li>
                    </ul>

                </li>

                <div style="display:none;" id="hiddenListItems-Review">
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                </div>

                <li class="nav-link <?= $current_page == 'aboutus.php' ? 'active' : '' ?>">
                    <a href="aboutus.php">
                        <i class='bx bx-group icon'></i>
                        <span class="text nav-text"> About Us</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?=ROOT ?>/doctorContactus/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/doctorContactus/index">
                        <i class='bx bx-phone-call icon'></i>
                        <span class="text nav-text"> Contact Us</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            
            <li class="nav-link" style="display:block">
                <a href="#" class="Profile-link">
                    <div class="profile">
                        <img src='<?= ROOT ?>/assets/images/common/defaultProfile.png' alt='profile pictu'>
                    </div>
                    <span class="text nav-text"> Profile</span>
                    <!-- <i class='bx bxs-down-arrow arrow first icon'></i> -->
                    <i class='bx bxs-up-arrow arrow first icon' ></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-link <?= $current_page == '<?=ROOT ?>/doctorProfile/index' ? 'active' : '' ?>">
                        <a href="<?= ROOT ?>/doctorProfile/index">
                            <i class='bx bx-edit icon'></i>
                            <span class="text nav-text" style="font-size:14px;">Edit profile</span>
                        </a>
                    </li>
                    <li class="nav-link <?= $current_page == 'toReview.php' ? 'active' : '' ?>">
                        <a href="toReview.php">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text" style="font-size:14px;">Sign out</span>
                        </a>
                    </li>
                </ul>

            </li>

            <div style="display:none;" id="hiddenListItems-Profile">
                <li style="display:block"></li>
                <li style="display:block"></li>
                </div>

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
<script src="<?= ROOT ?>/assets/js/vetDoctor/appointmentnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetDoctor/medicalnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetDoctor/reviewnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetDoctor/profilenavbar.js"></script>