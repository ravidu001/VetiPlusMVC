<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Owner Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/account.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <section class="home">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Account Dashboard</h1>
            </div>

            <div class="account-cards">
                <div class="account-card">
                    <i class="fas fa-users account-card-icon"></i>
                    <h2 class="account-card-title">User Accounts</h2>
                    <p class="account-card-count"><?php echo htmlspecialchars($userCount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="account-card">
                    <i class="fas fa-user-md account-card-icon"></i>
                    <h2 class="account-card-title">Doctor Accounts</h2>
                    <p class="account-card-count">56</p>
                </div>
                <div class="account-card">
                    <i class="fas fa-dog account-card-icon"></i>
                    <h2 class="account-card-title">Pet Accounts</h2>
                    <p class="account-card-count">120</p>
                </div>
                <div class="account-card">
                    <i class="fas fa-cut account-card-icon"></i>
                    <h2 class="account-card-title">Salon Accounts</h2>
                    <p class="account-card-count">20</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>