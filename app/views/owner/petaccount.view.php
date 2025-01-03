<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/petaccount.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <section class="home">
        <div class="pet-account">
            <div class="pet-account-inside">
                <div class="pet-account-inside-left">
                    <img src="../../assets/images/pet.jpg" alt="">
                </div>
                <table>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxl-baidu icon'></i>
                                <label for="id">Pet ID</label>
                            </div>
                        </td>
                        <td>
                            <h3>2200157</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-cat icon'></i>
                                <label for="name">Name</label>
                            </div>
                        </td>
                        <td>
                            <h3>Rocky</h3>
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
                    <tr>
                        <td>
                            <div class="regi-icon">
                                <i class='bx bxs-user-circle icon'></i>
                                <label for="petowner">Pet Owner</label>
                            </div>
                        </td>
                        <td>
                            <h3>Ramesh Peshala</h3>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</body>

</html>