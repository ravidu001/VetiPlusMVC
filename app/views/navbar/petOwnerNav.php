<?php $current_pg = basename(trim($_SERVER['REQUEST_URI'], '/')); ?>

<script>
    let link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = "<?= ROOT ?>/assets/css/petOwner/navBar.css";
    document.head.appendChild(link);
</script>

<nav class="navBar">

    <img src="<?= ROOT ?>/client/assets/images/vetiplus-logo.png" alt="VetiPlus logo" id="navBar-logo">

    <div class="links">
        <a href="<?= ROOT ?>/PO_home"
        class="<?= ($current_pg == 'home') ? 'active' : ''; ?>">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>

        <a href="#" id="appointmentIcon"
        class="<?= ($current_pg == 'PO_apptDashboard_Vet' || $current_pg == 'PO_apptDashboard_Salon') ? 'active' : ''; ?>">
            <i class="bx bxs-calendar-event bx-sm" ></i>
            <label for="appointmentIcon" class="collapsable">Appointments</label>
        </a>
        <div id="appointmentTypes">
            <a href="<?= ROOT ?>/PO_apptDashboard_Vet">
                <i class="bx bxs-injection bx-sm" id="vetAppointmentIcon"></i>
                <label for="vetAppointmentIcon" class="collapsable">Vet Appointments</label>
            </a>
            <a href="<?= ROOT ?>/PO_apptDashboard_Salon">
                <i class="bx bxs-brush bx-sm" id="salonAppointmentIcon"></i>
                <label for="salonAppointmentIcon" class="collapsable">Salon Appointments</label>
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
    <a href="<?= ROOT ?>/PO_petOwnerProfile"
    class="<?= ($current_pg == 'profilePage') ? 'active' : ''; ?>">
        <i class="bx bxs-user-circle bx-sm" id="profileIcon"></i>
        <label for="profileIcon">Profile</label>
    </a>

</nav>
