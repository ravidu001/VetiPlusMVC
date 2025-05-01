<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonoffer.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/deletepopup.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
<?= $notification->display(); ?>
    <div class="pagecontent">
        <div class="SidebarandSpecialOffers">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="SpecialOffers">
                <!-- <div class="SpecialContent"> -->
                    <h2> Special Offers</h2>
                    <div class="content-1">
                            <button class="add" id="specialservice-add">
                                <a href="<?=ROOT?>/SalonOffer/addoffer">Add</a>
                            </button>
                        </div>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Details 
                                </th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data) && !empty($data)): ?>
                                <?php foreach ($data as $x): 
                                // show($data);
                                    ?>
                                    
                                    <tr>
                                        <th>
                                            <div class="servicename">
                                                <?= htmlspecialchars($x['serviceName'] ?? 'No Service Name') ?>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="colunmcontent" style="display: flex;">
                                                <div class="one">
                                                    <h5 class="discount">Discount</h5>
                                                    <h3><?= htmlspecialchars($x['discount']) ?>%</h3>
                                                </div>
                                                <div class="two">
                                                    <h5 class="date">Open Date</h5>
                                                    <h3><?= date("d M Y", strtotime($x['startDate'])) ?></h3>
                                                </div>
                                                <div class="three">
                                                    <h5 class="date">Close Date</h5>
                                                    <h3><?= date("d M Y", strtotime($x['closeDate'])) ?></h3>
                                                </div>
                                                <div class="four">
                                                    <h5 class="date">Created Date</h5>
                                                    <h3><?= date("d M Y", strtotime($x['createDate'])) ?></h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class='ServiceDescription'>
                                                <?= htmlspecialchars($x['description']) ?> 
                                            </p>
                                        </td>
                                        <td>
                                            <button class='edit'>
                                                <a href='<?=ROOT ?>/SalonOffer/editoffer/<?= htmlspecialchars($x['specialOfferID']) ?>'>Edit</a>
                                            </button><br>
                                                <button class='delete' onclick="confirmDelete(<?= htmlspecialchars($x['specialOfferID']) ?>)"> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if(empty($data)){
                                ?>
                                <td colspan="4">No services Added yet</td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                <!-- </div> -->
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
    <script src="<?=ROOT?>/assets/js/salon/salonofferdelete.js"></script>
</body>
</html>

