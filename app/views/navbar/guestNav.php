<?php $current_pg = basename($_SERVER['PHP_SELF']); ?>

<nav class="navBar">

    <img src="<?= ROOT ?>/assets/images/vetiplus-logo.png" alt="VetiPlus logo" id="navBar-logo">

    <div class="links">
        <a href="<?= ROOT . '/index.php' ?>"
        class="<?= ($current_pg == 'index.php') ? 'active' : ''; ?>">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>
        <a href="<?= ROOT ?>/GuestServices.php/index"
        class="<?= ($current_pg == '<?= ROOT ?>/GuestServices.php/index') ? 'active' : ''; ?>">
            <i class="bx bxs-heart bx-sm" id="servicesIcon"></i>
            <label for="servicesIcon" class="collapsable">Services</label>
        </a>
        <a href="<?= ROOT ?>/GuestAboutUs.php/index"
        class="<?= ($current_pg == '<?= ROOT ?>/GuestAboutUs.php/index') ? 'active' : ''; ?>">
            <i class="bx bxs-like bx-sm" id="aboutIcon"></i>
            <label for="aboutIcon" class="collapsable">About Us</label>
        </a>
        <a href="<?= ROOT ?>/GuestContactUs.php/index"
        class="<?= ($current_pg == '<?= ROOT ?>/GuestContactUs.php/index') ? 'active' : ''; ?>">
            <i class="bx bxs-phone-call bx-sm" id="contactIcon"></i>
            <label for="contactIcon" class="collapsable">Contact Us</label>
        </a>
    </div>
    <a href="<?= ROOT . '/client/pages/login-singup/login.php' ?>" class="loginBtn">
        <i class="bx bxs-user-circle bx-sm" id="loginIcon"></i>
        <label for="loginIcon">Login</label>
    </a>
</nav>
