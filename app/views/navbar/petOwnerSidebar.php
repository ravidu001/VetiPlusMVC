<?php $current_pg = basename(trim($_SERVER['REQUEST_URI'], '/')); ?>

<script>
    let link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = "<?= ROOT ?>/assets/css/petOwner/sideBar.css";
    document.head.appendChild(link);
</script>

<nav class="sideBar">

    <img src="<?= ROOT ?>/assets/images/common/logo-nobg.png" alt="VetiPlus logo" id="sideBar-logo">

    <div class="links">
        <a href="<?= ROOT ?>/PO_home"
        class="<?= ($current_pg == 'PO_home') ? 'active' : ''; ?>">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>

        <a href="#" id="appointmentIcon"
        class="<?= ($current_pg == 'PO_vetAppointments' || $current_pg == 'PO_salonAppointments') ? 'active' : ''; ?>">
            <i class="bx bxs-calendar-event bx-sm" ></i>
            <label for="appointmentIcon" class="collapsable">Appointments</label>
        </a>
        <div id="appointmentTypes">
            <a href="<?= ROOT ?>/PO_vetAppointments">
                <i class="bx bxs-injection bx-sm" id="vetAppointmentIcon"></i>
                <label for="vetAppointmentIcon" class="collapsable">Vet</label>
            </a>
            <a href="<?= ROOT ?>/PO_salonAppointments">
                <i class="bx bxs-brush bx-sm" id="salonAppointmentIcon"></i>
                <label for="salonAppointmentIcon" class="collapsable">Salon</label>
            </a>
        </div>

        <a href="#" id="otherServiceIcon"
        class="<?= ($current_pg == 'PO_petAdoption' || $current_pg == 'PO_petBreeding') ? 'active' : ''; ?>">
            <i class="bx bxs-chevrons-right bx-sm" ></i>
            <label for="otherServiceIcon" class="collapsable">Other Services</label>
        </a>
        <div id="otherServiceTypes">
            <a href="<?= ROOT ?>/PO_petAdoption">
                <i class="bx bxs-dog bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Adoption</label>
            </a>
            <a href="<?= ROOT ?>/PO_petBreeding">
                <i class="bx bxs-heart bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Breeding</label>
            </a>
        </div>

        <a href="<?= ROOT ?>/PO_aboutUs"
        class="<?= ($current_pg == 'aboutUs') ? 'active' : ''; ?>">
            <i class="bx bxs-group bx-sm" id="aboutIcon"></i>
            <label for="aboutIcon" class="collapsable">About Us</label>
        </a>

        <a href="<?= ROOT ?>/PO_contactUs"
        class="<?= ($current_pg == 'contactUs') ? 'active' : ''; ?>">
            <i class="bx bxs-phone-call bx-sm" id="contactIcon"></i>
            <label for="contactIcon" class="collapsable">Contact Us</label>
        </a>
    </div>

    <div class="otherStuff">
        <div class="toggle-container" title="Change Theme">
            <input type="checkbox" id="themeToggle" class="toggle-input">
            <label for="themeToggle" class="toggle-label"></label>
        </div>
    
        <a href="<?= ROOT ?>/PO_petOwnerProfile"
        class="<?= ($current_pg == 'profilePage') ? 'active' : ''; ?>">
            <i class="bx bxs-user-circle bx-sm" id="profileIcon"></i>
            <label for="profileIcon" class="collapsable">Profile</label>
        </a>
    </div>
</nav>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const bodyClasses = document.body.classList
    
    const theme = localStorage.getItem('theme');
    
    // on mount
    theme && bodyClasses.add(theme);
    
    // handlers
    const handleThemeToggle = () => {
        bodyClasses.toggle('lightTheme');
        bodyClasses.toggle('darkTheme');
    
        console.log("Toggling theme!")
    
        if (bodyClasses.contains('darkTheme')) {
            localStorage.setItem('theme', 'darkTheme');
        } else {
            localStorage.setItem('theme', 'lightTheme');
        }
    };
    themeToggle.addEventListener('change', handleThemeToggle)
</script>