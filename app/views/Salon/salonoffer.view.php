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
                        </tbody>
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </div>

    
    <!-- Modal for confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to delete this service?</p>
            <button id="confirmDeleteBtn">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
    </div>



    <script>
    let serviceIDToDelete;

    function confirmDelete(serviceID) {
        serviceIDToDelete = serviceID;
        document.getElementById("deleteModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("deleteModal").style.display = "none";
    }

    // Create popup function
    function showPopup(message, isSuccess) {
        // Create popup container
        const popup = document.createElement('div');
        popup.style.cssText = `
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: ${isSuccess ? '#6a0dad' : '#f44336'};
            color: white;
            padding:30x 2px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
            text-align: center;
            font-weight: bold;
        `;
        
        popup.textContent = message;
        document.body.appendChild(popup);

        // Remove popup after 3 seconds
        setTimeout(() => {
            document.body.removeChild(popup);
        }, 3000);
    }

    document.getElementById("confirmDeleteBtn").onclick = function() 
    {
        if (serviceIDToDelete) 
        {
            fetch('<?= ROOT ?>/SalonOffer/deleteoffer/' + serviceIDToDelete, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                // Show popup based on response
                showPopup(data.message, data.success);

                // If successful, remove the row
                if (data.success) {
                    const rowToRemove = document.querySelector(`button[onclick="confirmDelete(${serviceIDToDelete})"]`).closest('tr');
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showPopup('An error occurred while deleting the service.', false);
            });

            // Close the confirmation modal
            closeModal();
        }
    }

    // Check for any existing messages on page load
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['message'])): ?>
            showPopup('<?= $_SESSION['message'] ?>', <?= isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'success' ? 'true' : 'false' ?>);
            <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>
    });
</script>
   
</body>
</html>