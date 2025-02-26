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

                        <img class="previewImage" src="" alt="Image Preview">

                        <label for="profilePicture">Add a profile picture:</label>
                            <input type="file" id="profilePicture" accept="image/*" name="profilePicture" required>

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
        
                        <label for="weight">Weight (in kg):</label>
                            <input type="number" id="weight" name="weight" min="0" placeholder="eg: 1" required>
                        
                        <label for="species">Species:</label>
                        <div class="selectOrOther">
                            <div class="selectContainer">
                                <select name="species" id="species" required>
                                    <option hidden>Select your pet's Species</option>
                                    <?php foreach ($this->speciesList as $sp) echo "<option value=\"{$sp->species}\">{$sp->species}</option>"; ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <input type="text" name="species" id="otherSpecies" class="other">
                        </div>
                        
                        <label for="breed">Breed:</label>
                        <div class="selectOrOther">
                            <div class="selectContainer">
                                <select name="breed" id="breed"></select>
                            </div>
                            <input type="text" name="breed" id="otherBreed" class="other" hidden>
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
            // to preview the uploaded image:
            document.getElementById("profilePicture").addEventListener("change", function(event) {
                let file = event.target.files[0];
                let img = document.querySelector(".previewImage");

                if (file) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        img.src = e.target.result;
                        img.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.style.display = "none"; // Hide the image if no file is selected
                    img.src = "";
                }
            });

            const species = document.getElementById('species');
            const breed = document.getElementById('breed');

            species.addEventListener('change', () => {
                const speciesType = species.value;

                if (speciesType == 'other') exit;
                const action = `PO_petRegister/breedList/${encodeURIComponent(speciesType)}`;

                fetch(action, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const optionsHTML = `
                        <option hidden>Select your pet's Breed</option>
                        ${data.map(x => `<option value=${x.breed}>${x.breed}</option>`).join('')}
                        <option value="other">Other</option>
                    `;
                    breed.innerHTML = optionsHTML;
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                    alert('An error occurred. Please try again later.');
                });
            })


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
