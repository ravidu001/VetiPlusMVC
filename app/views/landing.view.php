<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home - VetiPlus</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/guestUser/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/guestUser/guest_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/guestUser/guestHome.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

    </head>

    <body>
        <!-- navbar on top: -->
        <?php include 'navbar/guestNav.php' ?>

        <section class="hero-section">
            <header>
                VetiPlus:<br/>
                Connecting Pet Parents<br/>with<br/>Quality Care
            </header>
            <img class="heroImg" src="./assets/images/guestUser/guestHeroes/homeHero.png" alt="">
        </section>

        <section class="sectionWithHeader">
            <h1>Our Services</h1>
            <div class="serviceCards"></div>
        </section>
        

        <div class="homeDiv">
            <img src="./assets/images/guestUser/homeImg/SittingDoggo.png" alt="SittingDoggo">
            <div class="homeDivText">
                <h2>Pets do speak, but only to those who know how to listen.</h2>
                <p>Join the VetiPlus family today and connect with professionals who take pet care to another level.</p>    
                <a href="<?=ROOT.'/signup'?>" class="regBtn">
                    <button>Register</button>
                </a>
            </div>
        </div>

        <div class="homeDiv">
            <div class="homeDivText">
                <h2>Why Choose Us</h2>
                <p>
                    VetiPlus is a community of pet owners andservice providers revolutionizing pet care.
                    Whether you're a pet parent or a dedicated professional, 
                    VetiPlus provides the tools to makeyour experience seamless and rewarding.
                    Become part of our family today
                </p>    
                <a href="<?=ROOT.'/signup'?>" class="regBtn">
                    <button>Register</button>
                </a>
            </div>
            <img src="./assets/images/guestUser/homeImg/CuteDoggo.png" alt="SittingDoggo">
        </div>

        <section class="sectionWithHeader">
            <h1>Our Community</h1>
            <div class="userTypes">
                <div class="userCard">
                    <img src="./assets/images/guestUser/userTypes/petOwners.png" alt="">
                    <p class="userTitle">Pet Owner</p>
                    <p class="userDescription">
                        Care for your furry friend from
                        anywhere. Register to access 24/7
                        health records, and appointment
                        booking, knowing expert care is just
                        a click away.
                    </p>
                </div>
                <div class="userCard">
                    <img src="./assets/images/guestUser/userTypes/vetDoctor.png" alt="">
                    <p class="userTitle">Veterinary Doctor</p>
                    <p class="userDescription">
                        Expand your practice online. Join
                        our network to grow your client
                        base with tools for easy
                        appointment management, digital
                        prescriptions, and secure record
                        keeping.
                    </p>
                </div>
                <div class="userCard">
                    <img src="./assets/images/guestUser/userTypes/vetAssistant.png" alt="">
                    <p class="userTitle">Veterinary Assistant</p>
                    <p class="userDescription">
                        Streamline your work. Sign up to
                        efficiently collaborate seamlessly
                        with veterinarians and provide top
                        notch support to clients with
                        consultation sessions.
                    </p>
                </div>
                <div class="userCard">
                    <img src="./assets/images/guestUser/userTypes/salon.png" alt="">
                    <p class="userTitle">Pet Salon</p>
                    <p class="userDescription">
                        Boost your business. Register to
                        showcase your grooming services,
                        manage bookings, and connect with
                        pet owners in your area with
                        increased visibility
                    </p>
                </div>
            </div>
        </section>
        
        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/guestFooter.php'; ?>

        <script>
            const imgFolder = "./assets/images/guestUser/serviceIcons/"
            const services = [
                {
                    serviceName: "Vet Appointments",
                    imgLoc: imgFolder + "vetAppointmentIcon.png"
                },
                {
                    serviceName: "Salon Appointments",
                    imgLoc: imgFolder + "salonIcon.png"
                },
                {
                    serviceName: "Adoption",
                    imgLoc: imgFolder + "petAdoptionIcon.png"
                },
                {
                    serviceName: "Breeding",
                    imgLoc: imgFolder + "petBreedingIcon.png"
                },
                {
                    serviceName: "Unified Records",
                    imgLoc: imgFolder + "recordKeepingIcon.png"
                }
            ]
            document.querySelector('.serviceCards').innerHTML = services
                .map(ser => `<div class='serviceCard'>
                                <h4>${ser.serviceName}</h4>
                                <img src='${ser.imgLoc}'/>
                            </div>`).join('');
        </script>
    </body>
</html>
