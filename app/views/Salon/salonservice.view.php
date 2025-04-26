<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Service Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonservice.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/deletepopup.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonpopup.css">
    
</head>

<body>
    <?= $notification->display(); ?>
    <div id="notification" class="notification" style="display: none;"></div>
    <div class="pagecontent">
        <div class="sidebarandsevice">
            <div>
                <?php include __DIR__ . '/../navbar/salonnav.php'; ?>
            </div>
            <div class="Service-details">
                <h2 class="header-name">Service Details</h2>
                <div class="content-1">
                    <button class="add" id="service-add">
                        <a href="<?=ROOT?>/SalonService/add">Add</a>
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Service Details</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && !empty($data)) {
                            foreach ($data as $x) {
                                ?>
                                <tr>
                                    <td>
                                        <h4 class='ServiceName'><p><?= htmlspecialchars($x->serviceName) ?></p></h4><br>
                                        <h3 class='ServicePrice'><?= htmlspecialchars($x->serviceCharge) ?></h3><br>
                                    </td>
                                    <td>
                                        <img src="<?= htmlspecialchars($x->photo1) ?>" class='service-photo' alt='No Image Uploaded'>
                                        <img src="<?= htmlspecialchars($x->photo2) ?>" class='service-photo' alt='No Image Uploaded'>
                                    </td>
                                    <td>
                                        <p class='ServiceDescription'><?= htmlspecialchars($x->serviceDescription) ?></p><br>
                                    </td>
                                    <td>
                                        <button class='edit'>
                                            <a href='<?= ROOT ?>/SalonService/edit/<?= htmlspecialchars($x->serviceID) ?>'>Edit</a>
                                        </button>
                                        <button class='delete' onclick="confirmDelete(<?= htmlspecialchars($x->serviceID) ?>)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan='4'>No services found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
    
    <!-- Modal for confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="closebtn" onclick="closeModal()">&times;</span><br>
            <p class="ask">Are you sure you want to delete this Offer?</p>
            <button id="confirmDeleteBtn">Confirm</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
         const BASE_URL = "<?=ROOT?>";
    </script>
    <script src="<?=ROOT?>/assets/js/salon/salonservicedelete.js"></script>
</body>

</html>