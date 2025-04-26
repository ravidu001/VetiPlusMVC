<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Contact Us </title>  
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/contactUs.css" rel="stylesheet">
        
    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>
        <script> const ROOT = `<?= ROOT ?>`; </script>

        <div class="bodyArea">

            <section class="dashArea" id="FAQs">
                <h2 class="dashHeader">FAQ</h2>

                <details name="faq">
                    <summary>What is VetiPlus pet care management system?</summary>
                    VetiPlus is a web-based platform that connects pet owners with veterinary and grooming services.
                    It allows users to book appointments, manage schedules, and access various pet care features
                    in one convenient interface.
                </details>
                <details name="faq">
                    <summary>Who can use this system?</summary>
                    The system is designed for:
                    <ul><li>Pet owners: To book and manage vet or salon appointments.</li>
                        <li>Veterinarians: To handle consultations and manage schedules.</li>
                        <li>Pet salons: To manage grooming appointments and customer interactions.</li>
                        <li>Vet Assistants: To find and assist Veterinarians.</li>
                    </ul>
                </details>
                <details name="faq">
                    <summary>What services are supported by the system?</summary>
                    Our platform supports:
                    <ul><li>Petcare at your fingertips</li>
                        <li>Appointment management and scheduling.</li>
                        <li>Connecting service providers and pet-owners</li>
                    </ul>
                </details>
                <details name="faq">
                    <summary>How can I book an appointment?</summary>
                    Pet owners can log in, select the desired service (vet or salon),
                    choose an available date and time, and confirm the appointment.
                </details>
                <details name="faq">
                    <summary>Can I cancel or reschedule appointments?</summary>
                    Yes, pet owners can reschedule appointments upto a mximum of 3 per month at no additional cost.
                    Note, however, that no refunds will be issued at any normal circumstance.
                </details>
                <details name="faq">
                    <summary>Do I need to download anything to use the system?</summary>
                    No, the system is entirely web-based and can be accessed via a browser
                    on any device, including desktops, laptops, tablets, and smartphones.
                </details>
                <!-- <details name="faq">
                    <summary>What should I do if I forget my password?</summary>
                    Use the "Forgot Password" feature on the login page to reset your password.
                    Instructions will be sent to your registered email address.
                </details> -->
                <details name="faq">
                    <summary>Is my personal data secure?</summary>
                    Yes, the system employs secure data storage and encryption methods to protect all user data.
                </details>
                <details name="faq">
                    <summary>What if I encounter an issue with the system?</summary>
                    If you face any issues, once you are logged in, you can contact our support team via the feedback form.
                    We aim to resolve all queries ASAP.
                </details>
            </section>

            <section class="dashArea" id="vpDetails">
                <img src="<?= ROOT ?>/assets/images/petOwner/vp-logo.png" class="vpLogo" alt="VetiPlus logo">
                <div>
                    <h2>Address</h2>
                    <p>UCSC Building Complex,<br/>
                    35 Reid Ave,<br/>
                    Colombo 00700</p>
                </div>
                <div>
                    <h2>Email</h2>
                    <p>vetiplus737@gmail.com</p>
                </div>
                <div>
                    <h2>Call us</h2>
                    <p>+94 12 345 6789<br/>+94 12 345 6789</p>
                </div>
            </section>
    
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>

        </div>

        <!-- system feedback form -->
        <!-- <?php include ROOT.'/components/common/systemFeedbackForm.php'; ?> -->


    </body>
</html>