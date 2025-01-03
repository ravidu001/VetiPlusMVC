<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/petuseraccount.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <section class="home">
    <div class="user-account">
            <div class="user-account-inside">
                <div class="user-account-inside-left">
                    <img src="../../assets/images/user.png" alt="">
                </div>
                <table>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-user-circle icon'></i>
                                <label for="name"> Name</label>
                            </div>
                        </td>
                        <td>
                            <h3>Ramesh Peshala</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-envelope icon'></i>
                                <label for="email">Email</label>
                            </div>
                        </td>
                        <td>
                            <h3>rameshpeshala84@gmail.com</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-home icon'></i>
                                <label for="address">Address</label>
                            </div>
                        </td>
                        <td>
                            <h3>419,Gangasirigama,Thissamaharama</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-phone icon'></i>
                                <label for="phone_number">Phone Number</label>
                            </div>
                        </td>
                        <td>
                            <h3>0762163506</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-message-check icon'></i>
                                <label for="nic">NIC</label>
                            </div>
                        </td>
                        <td>
                            <h3>200212702901</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bx-child icon'></i>
                                <label for="gender">Gender</label>
                            </div>
                        </td>
                        <td>
                            <h3>Male</h3>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="user-account-outside">
                <div class="user-account-outside-left" id="main-content">
                    <a href="./petAccount.php">Pet Data</a>
                </div>
                <table>
                    <tr>
                        <td>
                            <div class="regi-icon">
                            <i class='bx bx-calendar-check icon'></i>
                                <label for="total_appointment">Total Appointment</label>
                            </div>
                        </td>
                        <td>
                            <h3>40</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                            <i class='bx bx-calendar-x icon'></i>
                                <label for="cancel_appointment">Cancel Appoinment</label>
                            </div>
                        </td>
                        <td>
                            <h3>10</h3>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</body>
</html>