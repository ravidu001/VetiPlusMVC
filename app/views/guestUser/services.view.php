<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Our Services</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/guestUser/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/guestUser/guest_commonStyles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/guestUser/servicesPage.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
        
    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/guestNav.php'; ?>

        <div class="hero-section">
            <div>
                <header>Our Services:</header>
                <p>
                    Join us today to enjoy a whole host of benefits and services from our professionals.
                </p>
            </div>
            <img class="heroImg" src="<?= ROOT ?>/assets/images/guestUser/guestHeroes/servicesHero.png" alt="">
        </div>

        <section class="dashArea">
            <div class="texts">
                <h2 class="dashHeader">Links to External Resources</h2>
                <ul class="extLinks"></ul>
            </div>
            <img src="<?=ROOT?>/assets/images/guestUser/studious-doggo.jpg" alt="studious-doggo" class="eduDoggo">
        </section>

        <div class="services">
            <div class="appointments">
                <div class=" card">
                    <div class="text">
                        <h1>Vet Appointments</h1>
                        <p> Book hassle-free veterinary appointments.
                            Access top-quality health care for your pets with just a few clicks.
                        </p>
                    </div>
                    <img src="<?= ROOT ?>/assets\images\guestUser\serviceIcons/vetAppointmentIcon.png" alt="Vet Appointments">
                </div>
                <div class=" card">
                    <div class="text">
                        <h1>Salon Appointments</h1>
                        <p> Pamper your pet with ease.
                            Schedule grooming sessions at your preferred pet salons through our platform.
                        </p>
                    </div>
                    <img src="<?= ROOT ?>/assets\images\guestUser\serviceIcons/salonIcon.png" alt="Salon Appointments">
                </div>
            </div>

            <div class="otherServices">
                <div class=" card">
                    <div class="text">
                        <h1>Adoption</h1>
                        <p> Find your perfect furry companion.
                            Connect with local shelters and other pet owners to give a loving home to a pet in need.
                        </p>
                    </div>
                    <img src="<?= ROOT ?>/assets\images\guestUser\serviceIcons/petAdoptionIcon.png" alt="">
                </div>
                <div class=" card">
                    <div class="text">
                        <h1>Pet Breeding</h1>
                        <p> Responsible pet breeding made simple.
                            Connect with reputable breeders or list your pet-breeding services on our platform.
                        </p>
                    </div>
                    <img src="<?= ROOT ?>/assets/images/guestUser/serviceIcons/petBreedingIcon.png" alt="">
                </div>
                <div class=" card">
                    <div class="text">
                        <h1>Unified Records</h1>
                        <p> Maintain records on your pet in one place.
                            No longer is it needed to carry about (and misplace) your pet's record books.
                        </p>
                    </div>
                    <img src="<?= ROOT ?>/assets/images/guestUser/serviceIcons/recordKeepingIcon.png" alt="">
                </div>
            </div>
        </div>
   
        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/guestFooter.php'; ?>

        <script>
            const linksObjects = [
                {text: 'Pet Health Tips from Petlearnia', extLink: 'https://petlearnia.com/pet-product-buying-advice'},
                {text: 'General Pet Education from ARF.org', extLink: 'https://www.arf-il.org/pet-owner-resources/pet-education'},
                {text: 'Doggy Tips by Embark Passion Sri Lanka', extLink: 'https://embarkpassion.com/publications/doggy-tips'},
                {text: '10 Responsible Pet Care Tips by Christine O\'Brien', extLink: 'https://www.hillspet.com/pet-care/routine-care/10-responsible-pet-care-tips?lightboxfired=true#'},
                {text: 'Pet Grooming Education Resources', extLink: 'https://ryanspet.com/education'},
                // {text: '', extLink: ''},
            ]
            const linksList = document.querySelector('.extLinks');
            linksList.innerHTML = linksObjects
                .map(x => `<li> <a href="${x.extLink}" target="_blank"> ${x.text} </a> </li>`).join('');

        </script>
    </body>
</html>
