<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register Pet</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/guestUser/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/registerPage.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <!-- <?php include_once '../app/views/navbar/petOwnerSidebar.php'; ?> -->

        <div class="formContainer">

            <div class="logoPart">
                <img src="<?= ROOT ?>/assets/images/petOwner/petRegister.png" alt="Pet Owner welcome image">
                <h3>Pet Registration</h3>
            </div>
                <form id="petRegisterForm" method="post" enctype="multipart/form-data" action="<?= ROOT.'/PO_petRegister/petRegister' ?>">
                    <h2>Register Your Pet</h2>
                    <div class="noField">

                        <!-- <img class="previewImage" src="" alt="Image Preview">
                        <label for="profilePicture">Add a profile picture:</label>
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required> -->

                        <label for="name">Name:</label>
                            <input type="text" id="name" name="name" minlength="3" placeholder="eg: Bingo" required> 
        
                        <label for="DOB">Date of Birth:</label>
                            <input type="date" id="DOB" name="DOB" max="<?= (new DateTime("now"))->format('Y-m-d') ?>" required>
                        
                        <label for="male">Gender:</label>
                            <div>
                                <label for="male">Male</label>
                                <input type="radio" id="male" value="male" name="gender" required>
                                <label for="female">Female</label>
                                <input type="radio" id="female" value="female" name="gender" required>
                            </div>
                        
                        <div class="species-breeds">
                            <div class="selectOrOther">
                                <label for="species">Species:</label>
                                <div class="selectContainer">
                                    <select name="species" id="species" required>
                                        <option value="ph" hidden>Select your pet's Species</option>
                                        <?php foreach ($this->speciesList as $sp) echo "<option value=\"{$sp->species}\">{$sp->species}</option>"; ?>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <input type="text" name="species" id="otherSpecies" class="other" placeholder="Enter your pet's general species" hidden>
                            </div>
                            
                            <div class="selectOrOther">
                                <label for="breed">Breed:</label>
                                <div class="selectContainer">
                                    <select name="breed" id="breed">
                                        <option value="ph" hidden> Select your pet's Species First. </option>
                                    </select>
                                </div>
                                <input type="text" name="breed" id="otherBreed" class="other" placeholder="Enter your pet's breed/specific species" hidden>
                            </div>

                            <p style="font-size:0.8em; text-align:center;">Check out exactly what species and breed your pet is with
                                <a href="https://images.google.com" target="_blank" style="text-decoration:none;">Google Images</a>
                            </p>
                        </div>


                        <!-- <label for="breedAvailNo">Is your pet available for breeding?</label>
                        <span>
                            <label for="breedAvailYes" class="radioLabel">Yes</label>
                                <input type="radio" id="breedAvailYes" name="breedAvailable" value="1" required onchange="toggleBreedDescription()">
                            <label for="breedAvailNo" class="radioLabel">No</label>
                                <input type="radio" id="breedAvailNo" name="breedAvailable" value="0" selected required onchange="toggleBreedDescription()">
                        </span> -->
        
                        <!-- <label for="breedDescription" class="breedDesc" id="breedDescriptionLabel" style="display:none;">Provide a description for breeding your pet:</label>
                            <textarea name="breedDescription" id="breedDescription" class="breedDesc input-field"
                                cols="30" rows="5" style="resize: none; display:none;" required>
                            </textarea> -->
        
        
                        </div>

                        <div class="errorMsg"></div>

                        <div class="formButtons">
                            <button type="reset">Clear</button>
                            <button type="submit">Submit</button>
                        </div>
        
                </form>
        </div>


        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/petOwnerFooter.php'; ?>


        <script>

            // the following parts are to handle user selecting other option for pet's species and/or breed and resetting them:
            const formItself = document.getElementById('petRegisterForm');

            const species = document.getElementById('species');
            const otherSpecies = document.getElementById('otherSpecies');

            const breed = document.getElementById('breed');
            const otherBreed = document.getElementById('otherBreed');

            species.addEventListener('change', () => {
                let speciesType = species.value;

                if (speciesType == 'other') {

                    otherSpecies.hidden = false;
                    otherSpecies.disabled = false;
                    otherSpecies.required = true;

                    breed.disabled = true;
                    otherBreed.hidden = false;
                    otherBreed.disabled = false;
                    otherBreed.required = true;
                }
                else {
                    otherSpecies.hidden = true;
                    otherSpecies.disabled = true;
                    otherSpecies.required = false;

                    breed.disabled = false;
                    otherBreed.hidden = true;
                    otherBreed.disabled = true;
                    otherBreed.required = false;

                    const action = `PO_petRegister/breedList/${encodeURIComponent(speciesType)}`;
    
                    fetch(action, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        const optionsHTML = `
                            <option value="ph" hidden> Select your pet's Breed </option>
                            ${data.map(x => `<option value=${x.breed}>${x.breed}</option>`).join('')}
                            <option value="other">Other</option>
                        `;
                        breed.innerHTML = optionsHTML;
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                        alert('An error occurred. Please try again later.');
                    });
                }
            })
            breed.addEventListener('change', () => {
                let breedType = breed.value;

                if (breedType == 'other') {

                    otherBreed.hidden = false;
                    otherBreed.disabled = false;
                    otherBreed.required = true;

                }
                else {

                    otherBreed.hidden = true;
                    otherBreed.disabled = true;
                    otherBreed.required = false;
                }
            })
            formItself.addEventListener('reset', (e) => {
                breed.innerHTML = `<option hidden> Select your pet's Species First. </option>`;
                
                otherSpecies.hidden = true;
                otherSpecies.disabled = true;
                otherSpecies.required = false;
                
                otherBreed.hidden = true;
                otherBreed.disabled = true;
                otherBreed.required = false;
            })
            formItself.addEventListener('submit', () => {
                if (species.value == 'ph' || breed.value == 'ph') {
                    console.log("Hmm");
                    e.preventDefault();
                }
            })


            // function toggleBreedDescription() {
            //     const breedDescParts = document.querySelectorAll('.breedDesc')
            //     if (document.getElementById('breedAvailYes').checked) {
            //         breedDescParts.forEach(x => x.style.display = "block")
            //     } else if (document.getElementById('breedAvailNo').checked) {
            //         breedDescParts.forEach(x => x.style.display = "none")
            //     }
            // }
        </script>
        
        <script src="<?=ROOT?>/assets/js/petOwner/fetchHandler.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>

    </body>
</html>
