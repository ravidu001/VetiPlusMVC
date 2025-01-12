<?php $current_pg = basename($_SERVER['PHP_SELF']); ?>

<nav class="navBar">

    <img src="<?= ROOT ?>/client/assets/images/vetiplus-logo.png" alt="VetiPlus logo" id="navBar-logo">

    <div class="links">
        <a href="<?= ROOT ?>/petOwner"
        class="<?= ($current_pg == 'home') ? 'active' : ''; ?>">
            <i class="bx bxs-home bx-sm" id="homeIcon"></i>
            <label for="homeIcon" class="collapsable">Home</label>
        </a>

        <a href="#" id="appointmentIcon"
        class="<?= ($current_pg == 'PO-vetAppointments' || $current_pg == 'PO-salonAppointments') ? 'active' : ''; ?>">
            <i class="bx bxs-calendar-event bx-sm" ></i>
            <label for="appointmentIcon" class="collapsable">Appointments</label>
        </a>
        <div id="appointmentTypes">
            <a href="<?= ROOT ?>/PO-vetAppointments">
                <i class="bx bxs-injection bx-sm" id="vetAppointmentIcon"></i>
                <label for="vetAppointmentIcon" class="collapsable">Vet Appointments</label>
            </a>
            <a href="<?= ROOT ?>/PO-salonAppointments">
                <i class="bx bxs-brush bx-sm" id="salonAppointmentIcon"></i>
                <label for="salonAppointmentIcon" class="collapsable">Salon Appointments</label>
            </a>
        </div>

        <a href="#" id="otherServiceIcon"
        class="<?= ($current_pg == 'PO-petAdoption' || $current_pg == 'PO-petBreeding') ? 'active' : ''; ?>">
            <i class="bx bxs-chevrons-right bx-sm" ></i>
            <label for="otherServiceIcon" class="collapsable">Appointments</label>
        </a>
        <div id="otherServiceTypes">
            <a href="<?= ROOT ?>/PO-petAdoption">
                <i class="bx bxs-dog bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Adoption</label>
            </a>
            <a href="<?= ROOT ?>/PO-petBreeding">
                <i class="bx bxs-heart bx-sm" id="otherServiceIcon"></i>
                <label for="otherServiceIcon" class="collapsable">Pet Breeding</label>
            </a>
        </div>

        <!-- <a href="<?= ROOT ?>/client/pages/petOwner/otherServices"
        class="<?= ($current_pg == 'otherServices') ? 'active' : ''; ?>">
            <i class="bx bxs-heart bx-sm" id="otherServiceIcon"></i>
            <label for="otherServiceIcon" class="collapsable">Other Services</label>
         </a> -->

        <a href="<?= ROOT ?>/PO-aboutUs"
        class="<?= ($current_pg == 'aboutUs') ? 'active' : ''; ?>">
            <i class="bx bxs-group bx-sm" id="aboutIcon"></i>
            <label for="aboutIcon" class="collapsable">About Us</label>
        </a>

        <a href="<?= ROOT ?>/PO-contactUs"
        class="<?= ($current_pg == 'contactUs') ? 'active' : ''; ?>">
            <i class="bx bxs-phone-call bx-sm" id="contactIcon"></i>
            <label for="contactIcon" class="collapsable">Contact Us</label>
        </a>
    </div>
    <a href="<?= ROOT ?>/PO-petOwnerProfile"
    class="<?= ($current_pg == 'profilePage') ? 'active' : ''; ?>">
        <i class="bx bxs-user-circle bx-sm" id="profileIcon"></i>
        <label for="profileIcon">Profile</label>
    </a>

</nav>
