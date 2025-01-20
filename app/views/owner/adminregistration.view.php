<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Admin Registration | VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/adminregistration.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="container">
            <div class="form-container">
                <div class="form-title">
                    <h1>Admin Registration</h1>
                </div>
                <form action="<?= ROOT ?>/OwnerAddAdmin/register" method="post">
                    <div class="form-group">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="name" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-envelope'></i>
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-lock'></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-home'></i>
                        <textarea placeholder="Full Address" id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-phone'></i>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-id-card'></i>
                        <input type="text" id="nic" name="nic" placeholder="NIC Number" required>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-user-detail'></i>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="submit-btn">Register Admin</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>