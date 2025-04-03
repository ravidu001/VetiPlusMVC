<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Book a Vet</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/appointmentPages.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    <body>

        <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?>

        <div class="bodyArea">
            
            <section class="dashArea">
                <h2 class="dashHeader">Book a Vet Appointment</h2>

                <div class="longCard-container upcomingAppt-container"></div>
                <template class="upcomingApptCard-template">
                    <div class="longCard upcomingApptCard">
                        <img src="<?= ROOT.'/assets/images/petOwner/serviceIcons/vetIcon.png' ?>" class="apptIcon" alt="apptIcon">
                        <div>
                            <p>
                                <span class="petName"></span>
                                <strong><span class="apptDate"></span></strong>
                            </p>
                            <p class="apptDescription"></p>
                            <p>
                                <strong><span class="docName"></span></strong>
                                <span class="docAddress"></span>
                            </p>
                        </div>
                        <div class="appintmentOptions">
                            <button><i class="bx bxs-edit bx-md"></i> Edit</button>
                            <button><i class="bx bxs-calendar-edit bx-md"></i> Reschedule</button>
                        </div>
                    </div>
                </template>

            </section>


            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>
            
        </div>
        
        <script src="<?=ROOT?>/assets/js/petOwner/cardPopulator.js"></script>
        <script defer>
            fetchAndAppendCards(
                'PO_apptDashboard_Vet/getUpcomingAppointments',
                '.upcomingApptCard-template',
                '.upcomingAppt-container'
            );
        </script>
    </body>
</html>