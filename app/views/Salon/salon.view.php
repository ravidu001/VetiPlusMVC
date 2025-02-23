<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salondashboard.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/guest/myFooter.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonpopup.css">

    <title>Document</title>
</head>
<body>
    <div class="homecontent">
        <div class="sideanddashbord">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="dash">
                <?php
                    include __DIR__ . '/salondashboard.view.php';
                ?>
            </div>
        </div> 

        <div>
            <?php
                // require "../../../app/views"; footer 
            ?>
        </div> 
    </div> 
</body>
    <script src="<?= ROOT?>/assets/js/salon/salonpopup.js"></script>
    <script src="<?= ROOT?>/assets/js/navbar/salonnav.js"></script>
    <script src="<?= ROOT?>/assets/js/salon/saloncalendar.js"></script> 
    <script src="<?= ROOT?>/assets/js/salon/salon.js"></script> 

</html>