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
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/Assistant/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/Assistant/index">
                        <i class='bx bx-home icon'></i>
                        <span class="text nav-text"> Home</span>
                    </a>
                </li>
                <li class="nav-link" style="display:block">
                    <a href="appointment.php" class="request-link">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text">Doctor Request</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <!-- Sub-menu should be inside the parent li -->

                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AssisRequest/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AssisRequest/index">
                                <i class='bx bx-calendar-plus icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Request</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AssisAccepted/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AssisAccepted/index">
                                <i class='bx bx-calendar-event icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Accepted Request</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AssisRequestHistory/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AssisRequestHistory/index">
                                <i class='bx bx-calendar-check icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Request History</span>
                            </a>
                        </li>
                    </ul>

                </li>

                <div style="display:none;" id="hiddenListItems-Request">
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
                        <!-- <li class="nav-link <?= $current_page == '<?= ROOT ?>/DoctorCertificate/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/DoctorCertificate/index">
                                <i class='bx bx-certification icon'></i>
                                <span class="text nav-text" style="font-size:14px;">Create Certificate</span>
                            </a>
                        </li> -->
                    </ul>

                </li>

                <div style="display:none;" id="hiddenListItems-Medical">
                    <li style="display:block"></li>
                    <li style="display:block"></li>
                    <!-- <li style="display:block"></li> -->
                </div>

                <li class="nav-link" style="display:block">
                    <a href="#" class="Review-link">
                        <i class='bx bx-message-rounded-dots icon'></i>
                        <span class="text nav-text"> Feedback</span>
                        <i class='bx bxs-down-arrow arrow first icon'></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AssisReview/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AssisReview/index">
                                <i class='bx bx-smile icon'></i>
                                <span class="text nav-text" style="font-size:14px;">My Reviews</span>
                            </a>
                        </li>
                        <li class="nav-link <?= $current_page == '<?= ROOT ?>/AssisToreview/index' ? 'active' : '' ?>">
                            <a href="<?= ROOT ?>/AssisToreview/index">
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
                <li class="nav-link <?= $current_page == '<?=ROOT ?>/AssisContactus/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/AssisContactus/index">
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
                        <?php $profilePicture = isset($_SESSION['profilePicture']) ? htmlspecialchars($_SESSION['profilePicture'], ENT_QUOTES, 'UTF-8') : 'defaultProfile.png'; ?>
                        <img src='<?= ROOT ?>/assets/images/vetAssistant/<?= $profilePicture ?>' alt='profile picture'>
                    </div>
                    <span class="text nav-text"> Profile</span>
                    <!-- <i class='bx bxs-down-arrow arrow first icon'></i> -->
                    <i class='bx bxs-up-arrow arrow first icon' ></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-link <?= $current_page == '<?=ROOT ?>/assisprofile/index' ? 'active' : '' ?>">
                        <a href="<?= ROOT ?>/assisProfile/index">
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
<script src="<?= ROOT ?>/assets/js/vetAssistant/requestnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetAssistant/medicalnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetAssistant/reviewnavbar.js"></script>
<script src="<?= ROOT ?>/assets/js/vetAssistant/profilenavbar.js"></script>