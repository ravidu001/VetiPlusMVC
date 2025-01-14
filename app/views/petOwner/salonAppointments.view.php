<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Salon Appointments</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/vetiplus-logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/styles.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/navBar.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/myFooter.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/petOwnerNav.php'; ?>

        <div class="dashContent">

            <section id="upcomingAppointments" class="dashArea">
                <h2>Upcoming Appointments</h2>
                <button class="expandCardSectionBtn" id="expandUpcomingAppointmentsBtn" title="Expand to view all"><i class="bx bxs-down-arrow-circle bx-lg"></i></button>
                <div class="appointments-container scrollAppointments">
                    <?php for ($i=0; $i<2; $i++) :?>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Bingo</h3>
                                <span>Full Bath - Mr.Perera</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.12.2024 | 6:00PM</h4>
                            </div>
                            <div class="appintmentOptions">
                                <button><i class="bx bxs-edit bx-md"></i> Edit</button>
                                <button><i class="bx bxs-calendar-edit bx-md"></i> Reschedule</button>
                            </div>
                        </div>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Ginger</h3>
                                <span>Nail Cutting - Miss.Rajamani</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.12.2024 | 6:00PM</h4>
                            </div>
                            <div class="appintmentOptions">
                                <button><i class="bx bxs-edit bx-md"></i> Edit</button>
                                <button><i class="bx bxs-calendar-edit bx-md"></i> Reschedule</button>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>

            <section id="historicalAppointments" class="dashArea">
                <h2>Appointments History</h2>
                <button class="expandCardSectionBtn" id="expandHstoricalAppointmentsBtn" title="Expand to view all"><i class="bx bxs-down-arrow-circle bx-lg"></i></button>
                <div class="appointments-container scrollAppointments">
                    <?php for ($i=0; $i<2; $i++) :?>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Bingo</h3>
                                <span>Full Bath - Mr.Perera</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.06.2024 | 6:00PM</h4>
                            </div>
                            <button><i class="bx bxs-star bx-md"></i> Rate Appointment</button>
                        </div>
                        <div class="appointmentCard">
                            <img src="<?= ROOT.'/assets/images/petOwner/salonIcon.png'?>" class="appointmentIcon" alt="appointmentIcon">
                            <div class="appointmentDetails">
                                <h3>Ginger</h3>
                                <span>Nail Cutting - Miss.Rajamani</span>
                                <span><b>Example Salon</b> No.103\1A, Hena Road, Mount-Lavinia</span>
                                <h4>05.10.2024 | 6:00PM</h4>
                            </div>
                            <div class="Rating">
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star bx-sm"></i>
                                <i class="bx bxs-star-half bx-sm"></i>
                                <i class="bx bx-star bx-sm"></i>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>

            <section id="availableSalons" class="dashArea">
                <h2>Salons Available</h2>
                <button class="expandCardSectionBtn" id="expandProvidersBtn" title="Expand to view all"><i class="bx bxs-down-arrow-circle bx-lg"></i></button>
                <div class="providerCard-container cardsScrollX">
                    <?php for ($i=0; $i<4; $i++) :?>
                        <div class="providerCard">
                            <img src="<?= ROOT ?>/assets/images/Teeth cleaning.jpg" alt="salon Profile Picture">
                            <h2>Example Salon</h2>
                            <span class="address">No.103\1A, Hena Road, Mount-Lavinia</span>
                            <span><b>Contact:</b> 0767130191</span>
                            <span><b>Rating:</b> 4.0</span>
                        </div>
                        <div class="providerCard">
                            <img src="<?= ROOT ?>/assets/images/Ear cleaning.jpg" alt="salon Profile Picture">
                            <h2>Example Salon</h2>
                            <span class="address">No.103\1A, Hena Road, Mount-Lavinia</span>
                            <span><b>Contact:</b> 0767130191</span>
                            <span><b>Rating:</b> 4.0</span>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        </div>

        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

        <script src="appointmentPages.js"></script>
    </body>
</html>