<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About Us</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/vetiplus-logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/styles.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/navBar.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/myFooter.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/poppinsFont.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/aboutPage.css" rel="stylesheet">

        <!-- <link href="<?= ROOT ?>/assets/css/petOwner/dashboard.css" rel="stylesheet"> -->
    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/petOwnerNav.php'; ?>

        <div class="content">    
            <!-- sections containing text and info -->
            <section class="aboutSections">
                <img src="../../assets/images/guestUser/aboutUs/ourStory.png" alt="Our Story">
                <div class="text">
                    <header class="mainH">Our Story</header>
                    <p>
                        At VetiPlus, our story began with a simple goal:
                        to create a platform that brings together pet owners and service providers
                        in a way that benefits the entire pet community.
                        As passionate pet lovers ourselves, we recognized the challenges many face
                        in finding reliable, high-quality care for their furry companions.
                        Through VetiPlus, we aim to foster a thriving ecosystem
                        where pet owners can easily access the services they need,
                        while service providers can expand their reach and connect with more devoted clients.
                        Our mission is to make pet care more accessible, convenient, and community-driven,
                        so that every pet can receive the love and attention they deserve.
                    </p>
                </div>
            </section>
            <section class="aboutSections">
                <img src="../../assets/images/guestUser/aboutUs/joinUs.png" alt="Join the VetiPlus family">
                <div class="text">
                    <header>Join the<br/>VetiPlus family</header>
                    <p>
                        Join the VetiPlus community of pet owners and service providers revolutionizing pet care.
                        Whether you're a pet parent or a dedicated professional,
                        VetiPlus provides the tools to make your experience seamless and rewarding.
                        Become part of our family today.
                    </p>
                </div>
            </section>
            <section class="aboutSections">
                <div class="text">
                    <header>The VetiPlus Team </header>
                    <p>
                        The VetiPlus team is comprised of passionate pet enthusiasts and experienced industry professionals.
                        Our diverse backgrounds in veterinary care, pet grooming, technology, and customer service
                        allow us to build innovative solutions that cater to the unique needs of both pet owners and service providers.
                        Together, we are committed to elevating the standard of pet care and fostering a thriving community of animal lovers.
                    </p>
                </div>
                <img src="../../assets/images/guestUser/aboutUs/theTeam.png" alt="">
            </section>
        </div>

        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

    </body>
</html>