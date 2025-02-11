<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Owner Registeration</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/guestUser/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/guestUser/styles.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/guestUser/navBar.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/guestUser/myFooter.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/petOwner/registerPage.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="formContainer">

            <div class="logoPart">
                <img src="<?= ROOT ?>/assets/images/guestUser/petOwner-welcome.png" alt="Pet Owner welcome image">
                <h3>Welcome to VetiPlus!</h3>
            </div>
            
            <form id="petOwnerRegisterForm" method="post" action="<?= ROOT ?>/PO_register/petOwnerRegister">
                <h1>Pet Owner Signup</h1>
                <fieldset>
                    <legend>Personal Details</legend>
                    <label for="name">Name</label>
                        <input type="text" id="name" name="name" minlength="5" placeholder="eg: John Doe" required>
                    <?php 
                        $today = new DateTime("now");
                        $todayDate = $today->format('Y-m-d');
                        $tenYearsAgoDate = (clone $today)->modify('-10 years')->format('Y-m-d');
                    ?>
                    <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" max="<?= $tenYearsAgoDate ?>" required>
                    <label for="contact">Contact Number</label>
                        <input type="text" id="contact" name="contact" pattern="07\d\d\d\d\d\d\d\d" minlength="10" placeholder="eg: 0767130191" required>
                    <label for="nic">NIC number</label>
                        <input type="text" id="nic" name="nic" placeholder="eg: 200229001015 or 712441524V" pattern="(?:[4-9][0-9]{8}[vVxX])|(?:[12][0-9]{11})" required>
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
                
                <span id="errorMsg"></span>
                <div class="formButtons">
                    <button type="reset">Clear</button>
                    <button type="submit">Submit</button>
                </div>

            </form>

            <!-- 
            <form id="petOwnerRegisterForm" method="post" action="<?= ROOT ?>/PO_register/petOwnerRegister">
                <div class="form-steps">
                    <div class="step active">1</div>
                    <div class="step">2</div>
                    <div class="step">3</div>
                </div>

                <div class="form-section active" id="personalInfo">
                    <h3>Personal Information</h3>
                    <label for="name">Name</label>
                        <input type="text" id="name" name="name" minlength="5" placeholder="eg: John Doe" required>
                    <?php 
                        $today = new DateTime("now");
                        $todayDate = $today->format('Y-m-d');
                        $tenYearsAgoDate = (clone $today)->modify('-10 years')->format('Y-m-d');
                    ?>
                    <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" max="<?= $tenYearsAgoDate ?>" required>
                    <label for="contact">Contact Number</label>
                        <input type="text" id="contact" name="contact" pattern="07\d\d\d\d\d\d\d\d" minlength="10" placeholder="eg: 0767130191" required>
                    <label for="nic">NIC number</label>
                        <input type="text" id="nic" name="nic" placeholder="eg: 200229001015 or 712441524V" pattern="(?:[4-9][0-9]{8}[vVxX])|(?:[12][0-9]{11})" required>
                    <label for="male">Gender</label>
                        <div>
                            <label for="male">Male</label>
                            <input type="radio" id="male" value="male" name="gender" required>
                            <label for="female">Female</label>
                            <input type="radio" id="female" value="female" name="gender" required>
                        </div>
                        
                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" disabled>Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                </div>

                <div class="form-section" id="addressInfo">
                    <h3>Address</h3>
                    <label for="houseNo">Apartment/ House no.</label>
                        <input type="text" id="houseNo" name="houseNo" placeholder="eg: 103/1A" required>
                    <label for="streetName">Street</label>
                        <input type="text" id="streetName" name="streetName" placeholder="eg: Hena Road" required>
                    <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="eg: Mount-Lavinia" required>
                        
                    <div class=" navigation-buttons">
                        <button type="button" class="btn btn-secondary previous-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                </div>

                <div class="form-section" id="profilePicture">
                    <form action="">
                        <h3>Profile Picture</h3>
                        <label for="profilePic">Upload Profile Picture</label>
                        <input type="file" id="profilePic" name="profilePic" accept=".jpg,.jpeg,.png" required>
                    </form>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary previous-step">Previous</button>
                        <button type="submit" class="btn btn-primary">Complete Registration</button>
                    </div>

                </div>
            </form>
            -->
        </div>
        
        <!-- footer at page's bottom: -->
        <?php include ROOT.'/client/components/guestUser/guestFooter.php'; ?>

        <script>
            document.getElementById('petOwnerRegisterForm').addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error(`HTTP Error: ${response.status}`);
                    }
                })
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.href = '<?= ROOT.'/client/pages/petOwner/home.php' ?>';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('An error occurred\n'+ error);
                    alert('An error occurred.\nPlease try again later.\n'+ error);
                })
            })
        </script>
    </body>
</html>