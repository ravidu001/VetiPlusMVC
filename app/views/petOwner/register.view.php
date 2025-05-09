<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pet Owner Registeration</title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/guestUser/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/registerPage.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
        <script> const ROOT = `<?= ROOT ?>`; </script>
        <div class="formContainer">

            <div class="logoPart">
                <img src="<?= ROOT ?>/assets/images/petOwner/poRegister.png" alt="Pet Owner welcome image">
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
                    <!-- <label for="NIC">NIC number</label>
                        <input type="text" id="NIC" name="NIC" placeholder="eg: 200229001015 or 712441524V" pattern="(?:[4-9][0-9]{8}[vVxX])|(?:[12][0-9]{11})" required> -->
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
                    <label for="district">District</label>
                        <input type="text" id="district" name="district" placeholder="eg: Colombo" required>
                </fieldset>
                
                <div class="errorMsg"></div>
                <div class="formButtons">
                    <button type="reset">Clear</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        
        <!-- footer at page's bottom: -->
        <?php include_once '../app/views/navbar/guestFooter.php'; ?>
        
        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <script>
            document.getElementById('petOwnerRegisterForm').addEventListener('submit', submitForm);
        </script>

    </body>
</html>