<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Adoption</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/vetiplus-logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/styles.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/navBar.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/myFooter.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/otherServicePages.css" rel="stylesheet">
        
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/petOwnerNav.php'; ?>

        <div class="dashContent">

            <section class="dashArea" id="myListings">
                <h2>My Listings</h2>
                <button>List new pet for Adoption</button>
                <div class="listingsList">
                    <p>No pets listed for adoption</p>
                </div>
            </section>

            <section class="dashArea">
                <h1>Pets for Adoption</h1>
                <i>Search and adopt a pet in need of your care from anywhere in the country.</i>
                <div class="filters">
                    <div class="filterSearchContainer">
                        <label for="locationFilter">Filter by Location: </label>
                        <input type="search" id="locationFilter" placeHolder="filter by Location">
                    </div>
                    <div class="filterSearchContainer">
                        <label for="speciesFilter">Filter by Species: </label>
                        <input type="search" id="speciesFilter" placeHolder="filter by Species">
                    </div>
                    <div class="filterSearchContainer">
                        <label for="breedFilter">Filter by Breed: </label>
                        <input type="search" id="breedFilter" placeHolder="filter by Breed">
                    </div>
                </div>
                <div class="searchResults">
                <?php for($i=0; $i<3; $i++): ?>
                    <div class="itemCard">
                        <img src="<?= ROOT.'/assets/images/puppy1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Labrador Puppies</h3>
                            <span>Starting Rs.10000</span>
                            <span><b>Gampaha, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0779830154</span>
                            <span><b>Last check-up:</b> 20.11.2024</span>
                        </div>
                    </div>
                    <div class="itemCard">
                        <img src="<?= ROOT.'/assets/images/kitten1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Kittens for a kind home</h3>
                            <span>Free</span>
                            <span><b>Wellawatte, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0779830154</span>
                            <span><b>Last check-up:</b> 21.11.2024</span>
                        </div>
                    </div>
                <?php endfor; ?>
                </div>
            </section>
        </div>

        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>

    </body>
</html>