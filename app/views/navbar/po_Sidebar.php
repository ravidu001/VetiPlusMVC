<?php $current_pg = basename(trim($_SERVER['REQUEST_URI'], '/')); ?>

<script>
    let sideBarLink = document.createElement('link');
    sideBarLink.rel = 'stylesheet';
    sideBarLink.href = "<?= ROOT ?>/assets/css/petOwner/sideBar.css";
    document.head.appendChild(sideBarLink);
</script>

<nav class="sideBar">

    <img src="<?= ROOT ?>/assets/images/petOwner/vp-logo.png" alt="VetiPlus logo" id="sideBar-logo">

    <div class="links">
        <a href="<?= ROOT ?>/PO_home"
        class="<?= ($current_pg == 'PO_home') ? 'active' : ''; ?>" title="Home">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>

        <a href="#" id="appointmentIcon"
        class="<?= ($current_pg == 'PO_apptDashboard_Vet' || $current_pg == 'PO_apptDashboard_Salon') ? 'active' : ''; ?>" title="Appointments">
            <i class="bx bxs-calendar-event bx-sm" ></i>
            <label for="appointmentIcon" class="collapsable">Appointments</label>
        </a>
        <div id="appointmentTypes">
            <a href="<?= ROOT ?>/PO_apptDashboard_Vet"
            class="<?= ($current_pg == 'PO_apptDashboard_Vet') ? 'active' : ''; ?>" title="Vet Appointments">
                <i class="bx bxs-injection bx-sm" id="vetAppointmentIcon"></i>
                <label for="vetAppointmentIcon" class="collapsable">Vet</label>
            </a>
            <a href="<?= ROOT ?>/PO_apptDashboard_Salon"
            class="<?= ($current_pg == 'PO_apptDashboard_Salon') ? 'active' : ''; ?>" title="Salon Appointments">
                <i class="bx bxs-brush bx-sm" id="salonAppointmentIcon"></i>
                <label for="salonAppointmentIcon" class="collapsable">Salon</label>
            </a>
        </div>

        <a href="#" id="otherServiceIcon"
        class="<?= ($current_pg == 'PO_petAdoption' || $current_pg == 'PO_petBreeding') ? 'active' : ''; ?>" title="Other Services">
            <i class="bx bxs-chevrons-right bx-sm" ></i>
            <label for="otherServiceIcon" class="collapsable">Other Services</label>
        </a>
        <div id="otherServiceTypes">
            <a href="<?= ROOT ?>/PO_petAdoption"
            class="<?= ($current_pg == 'PO_petAdoption') ? 'active' : ''; ?>" title="Pet Adoption">
                <i class="bx bxs-dog bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Adoption</label>
            </a>
            <a href="<?= ROOT ?>/PO_petBreeding"
            class="<?= ($current_pg == 'PO_petBreeding') ? 'active' : ''; ?>" title="Pet Breeding">
                <i class="bx bxs-heart bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Breeding</label>
            </a>
        </div>

        <a href="<?= ROOT ?>/PO_aboutUs"
        class="<?= ($current_pg == 'PO_aboutUs') ? 'active' : ''; ?>" title="About Us">
            <i class="bx bxs-group bx-sm" id="aboutIcon"></i>
            <label for="aboutIcon" class="collapsable">About Us</label>
        </a>

        <a href="<?= ROOT ?>/PO_contactUs"
        class="<?= ($current_pg == 'PO_contactUs') ? 'active' : ''; ?>" title="Contact Us">
            <i class="bx bxs-phone-call bx-sm" id="contactIcon"></i>
            <label for="contactIcon" class="collapsable">Contact Us</label>
        </a>
    </div>

    <div class="otherStuff">
        <div class="toggle-container" title="Change Theme">
            <input type="checkbox" id="themeToggle" class="toggle-input">
            <label for="themeToggle" class="toggle-label"></label>
        </div>
    
        <a href="<?= ROOT ?>/PO_userProfile"
        class="<?= ($current_pg == 'PO_userProfile') ? 'active' : ''; ?>">
            <i class="bx bxs-user-circle bx-sm" id="profileIcon"></i>
            <label for="profileIcon" class="collapsable">Profile</label>
        </a>
    </div>
</nav>

<!-- the script part for theme toggling: -->
<script>
    const themeToggle = document.getElementById('themeToggle');
    const bodyClasses = document.body.classList
    
    const theme = localStorage.getItem('theme');
    theme && bodyClasses.add(theme);
    
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