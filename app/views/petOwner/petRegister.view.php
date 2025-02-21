<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register Pet</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link href="<?= ROOT ?>/assets/css/petOwner/formStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/registerPage.css" rel="stylesheet">
    </head>
    <body>
        <!-- <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?> -->

        <div class="formContainer">

            <div class="logoPart">
                <img src="<?= ROOT ?>/assets/images/petOwner/petRegister.png" alt="Pet Owner welcome image">
                <h3>Welcome to VetiPlus!</h3>
            </div>

            <form id="petOwnerRegisterForm" method="post" action="<?= ROOT ?>/PO_register/petOwnerRegister">
                <h1>Pet Owner Signup</h1>
                <fieldset>
                    <legend>Personal Details</legend>
                    <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" minlength="5" placeholder="eg: John Doe" required>
                    <?php 
                        $today = new DateTime("now");
                        $todayDate = $today->format('Y-m-d');
                        $tenYearsAgoDate = (clone $today)->modify('-10 years')->format('Y-m-d');
                    ?>
                    <label for="DOB">Date of Birth</label>
                        <input type="date" id="DOB" name="DOB" max="<?= $tenYearsAgoDate ?>" required>
                    <label for="contactNumber">Contact Number</label>
                        <input type="text" id="contactNumber" name="contactNumber" pattern="07\d\d\d\d\d\d\d\d" minlength="10" placeholder="eg: 0767130191" required>
                    <label for="NIC">NIC number</label>
                        <input type="text" id="NIC" name="NIC" placeholder="eg: 200229001015 or 712441524V" pattern="(?:[4-9][0-9]{8}[vVxX])|(?:[12][0-9]{11})" required>
                    <label for="male">Gender</label>
                        <div>
                            <label for="male">Male</label>
                            <input type="radio" id="male" value="male" name="gender" required>
                            <label for="female">Female</label>
                            <input type="radio" id="female" value="female" name="gender" required>
                        </div>
                </fieldset>
                <fieldset>
                    <legend>Address</legend>
                    <label for="houseNo">Apartment/ House no.</label>
                        <input type="text" id="houseNo" name="houseNo" placeholder="eg: 103/1A" required>
                    <label for="streetName">Street</label>
                        <input type="text" id="streetName" name="streetName" placeholder="eg: Hena Road" required>
                    <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="eg: Mount-Lavinia" required>
                </fieldset>
                
                <div class="errorMsg"></div>
                <div class="formButtons">
                    <button type="reset">Clear</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
            
                <form method="post" enctype="multipart/form-data" id="petRegisterForm"
                    action="<?= ROOT.'/server/controllers/petOwner/petRegisterHandle.php' ?>">
    
                    <h2>Register Your Pet</h2><br/>
    
                    <label>Name:</label>
                        <input type="text" id="name" name="name" required> 
    
                    <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" max="<?= (new DateTime("now"))->format('Y-m-d') ?>" required>
                    
                    <label>Gender:</label>
                        <span>
                            <label for="male" class="radioLabel">Male:</label>
                                <input type="radio" id="male" name="gender" value="male" required>
                            <label for="female" class="radioLabel">Female:</label>
                                <input type="radio" id="female" name="gender" value="female" required>
                        </span>
    
                    <label for="weight">Weight:</label>
                        <input type="number" id="weight" name="weight" min="0" required>
                        
                    <label for="species">Species:</label>
                        <input type="text" id="species" name="species" list="petSpecies">
                        <datalist id="petSpecies">
                            <option value="Dog">
                            <option value="Cat">
                            <option value="Rabbit">
                            <option value="Bird">
                            <option value="Hamster">
                        </datalist>
    
                    <label for="breed">Breed:</label>
                        <input type="text" id="breed" name="breed" required>
    
                    <label for="breedAvailNo">Is your pet available for breeding?</label>
                    <span>
                        <label for="breedAvailYes" class="radioLabel">Yes</label>
                            <input type="radio" id="breedAvailYes" name="breedAvailable" value="1" required onchange="toggleBreedDescription()">
                        <label for="breedAvailNo" class="radioLabel">No</label>
                            <input type="radio" id="breedAvailNo" name="breedAvailable" value="0" selected required onchange="toggleBreedDescription()">
                    </span>
    
                    <label for="breedDescription" class="breedDesc" id="breedDescriptionLabel" style="display:none;">Provide a description for breeding your pet:</label>
                        <textarea name="breedDescription" id="breedDescription" class="breedDesc input-field"
                            cols="30" rows="5" style="resize: none; display:none;" required>
                        </textarea>
    
                    <label for="profilePicture">Add a profile picture:</label>
                        <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required>
    
                    <span></span>   <!-- Empty span for grid layout -->
                    <button type="reset">Clear</button>
                    <button type="submit">Add Pet</button>
                    
                </form>
        </div>


        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>


        <script>
            function toggleBreedDescription() {
                const breedDescParts = document.querySelectorAll('.breedDesc')
                if (document.getElementById('breedAvailYes').checked) {
                    breedDescParts.forEach(x => x.style.display = "block")
                } else if (document.getElementById('breedAvailNo').checked) {
                    breedDescParts.forEach(x => x.style.display = "none")
                }
            }
        </script>
    </body>
</html>
