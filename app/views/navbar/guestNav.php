<?php $current_pg = basename(trim($_SERVER['REQUEST_URI'], '/')); ?>

<!-- Link the css file dynamically: -->
<script>
    let navBarLink = document.createElement('link');
    navBarLink.rel = 'stylesheet';
    navBarLink.href = "<?= ROOT ?>/assets/css/guestUser/navBar.css";
    document.head.appendChild(navBarLink);
</script>

<nav class="navBar">

    <img src="<?= ROOT ?>/assets/images/common/logo.png" alt="VetiPlus logo" id="navBar-logo">

    <div class="links">
        <a href="<?= ROOT ?>/guestUser"
        class="<?= ($current_pg == 'guestUser') ? 'active' : ''; ?>">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>
        <a href="<?= ROOT ?>/guestServices"
        class="<?= ($current_pg == 'guestServices') ? 'active' : ''; ?>">
            <i class="bx bxs-heart bx-sm" id="servicesIcon"></i>
            <label for="servicesIcon" class="collapsable">Services</label>
        </a>
        <a href="<?= ROOT ?>/guestAboutUs"
        class="<?= ($current_pg == 'guestAboutUs') ? 'active' : ''; ?>">
            <i class="bx bxs-like bx-sm" id="aboutIcon"></i>
            <label for="aboutIcon" class="collapsable">About Us</label>
        </a>
        <a href="<?= ROOT ?>/guestContactUs"
        class="<?= ($current_pg == 'guestContactUs') ? 'active' : ''; ?>">
            <i class="bx bxs-phone-call bx-sm" id="contactIcon"></i>
            <label for="contactIcon" class="collapsable">Contact Us</label>
        </a>
    </div>
    <a href="<?= ROOT.'/login' ?>" class="loginBtn">
        <i class="bx bxs-user-circle bx-sm" id="loginIcon"></i>
        <label for="loginIcon">Login</label>
    </a>
</nav>
