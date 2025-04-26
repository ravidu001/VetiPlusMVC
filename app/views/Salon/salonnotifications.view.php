<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Notifications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonnotifications.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="pagecontent">
        <div class="header">
            <h1>Notifications</h1>
            <div class="dashboard-icon" id="icon">
                <a href="<?=ROOT?>/Salon">
                    <i class="fa-solid fa-circle-xmark pageclose"></i>
                </a>
            </div>
        </div>

        <div class="notifications">       
        </div>
    </div>
</body>
<script>
    const BASE_URL = "<?= ROOT ?>";
</script>
    <script src="<?=ROOT?>/assets/js/salon/notifications.js"></script>
</html>