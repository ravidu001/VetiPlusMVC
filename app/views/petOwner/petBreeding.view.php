<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Breeding</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/petOwner/otherServicePages.css" rel="stylesheet">
        
        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <script> const ROOT = `<?= ROOT ?>`; </script>
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>

        <div class="bodyArea">

            <section class="dashArea" id="myListings">
                <h2>My Listings</h2>
                <button>List new pet for Breeding</button>
                <div class="listingsList">
                    <p>No pets made available for breeding</p>
                </div>
            </section>

            <section class="dashArea">
                <h1>Pets for Breeding</h1>
                <i>Search and breed your pets in a safe and responsible manner.</i>
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
                        <img src="<?= ROOT.'/assets/images/adultDog1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Golden Retriever (Male)</h3>
                            <span>Rs.15000</span>
                            <span><b>Kandy, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0713167854</span>
                            <span><b>Last check-up:</b> 25.10.2024</span>
                        </div>
                    </div>
                    <div class="itemCard">
                        <img src="<?= ROOT.'/assets/images/adultCat1.jpg' ?>" alt="">
                        <div class="itemDetails">
                            <h3>Persian Cat (Male)</h3>
                            <span>Rs.10000</span>
                            <span><b>Dehiwela, Sri Lanka</b></span>
                            <span><b>Contact:</b> 0713167854</span>
                            <span><b>Last check-up:</b> 10.11.2024</span>
                        </div>
                    </div>
                <?php endfor; ?>
                </div>
            </section>
            
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>
        </div>


    </body>
</html>