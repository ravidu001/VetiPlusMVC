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
            <ul class="menu-links">
                <h4>Main Menu</h4>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/Owner/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/Owner/index">
                        <i class='bx bx-home icon'></i>
                        <span class="text nav-text"> Dashbord</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/OwnerAppointment/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/OwnerAppointment/index">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text">Appointment</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/OwnerAccount/index' ? 'active' : '' ?>">
                    <a href="<?= ROOT ?>/OwnerAccount/index">
                        <i class='bx bx-group icon'></i>
                        <span class="text nav-text"> Account</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/OwnerPayment/index' ? 'active' : '' ?>">
                <a href="<?= ROOT ?>/OwnerPayment/index">
                <i class='bx bx-dollar icon'></i>
                        <span class="text nav-text"> Payment</span>
                    </a>
                </li>
                <li class="nav-link <?= $current_page == '<?= ROOT ?>/OwnerAddAdmin/index' ? 'active' : '' ?>">
                <a href="<?= ROOT ?>/OwnerAddAdmin/index">
                        <i class='bx bxs-user-plus icon'></i>
                        <span class="text nav-text">Add Admin</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
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