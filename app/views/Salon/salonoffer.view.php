<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonoffer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
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
                                <?php
                                    // require_once("../../components/common/serchbar.php")
                                ?>
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
   
    <style>
    /* Modal Background */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    overflow-y: auto;
    left: 0;
    top: 0;
    width: 100%;
    height: 150%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

/* Modal Content Box */
.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px 30px;
    border: 1px solid #888;
    width: 400px;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
    text-align: center;
}

/* Close Button (X) */
.closebtn {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.ask {
    margin: 10px;
    padding: 10px 5px;
}

/* Buttons */
.modal-content button {
    padding: 10px 16px;
    margin: 10px 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.modal-content #confirmDeleteBtn {
    background-color: #6a0dad;
    color: white;
}

.modal-content button:hover {
    opacity: 0.9;
}
</style>

</body>
</html>

<script>
    let deleteOfferId = null;

    // Show the modal and set the ID to delete
    function confirmDelete(offerId) {
        deleteOfferId = offerId;
        document.getElementById('deleteModal').style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        deleteOfferId = null;
    }

    // Handle confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteOfferId !== null) {
            const formData = deleteOfferId;
            
            // console.log(deleteOfferId);
            // console.log(formData);
            
            fetch(`${BASE_URL}/SalonOffer/deleteoffer`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Refresh the page after deletion
                } else {
                    alert('Error: ' + data.message);
                }
                closeModal();
            })
            .catch(error => {
                alert('An error occurred: ' + error);
                closeModal();
            });
        }
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
