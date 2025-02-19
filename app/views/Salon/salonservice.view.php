<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Service Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonservice.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonpopup.css">
    
</head>


<body>
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
            fetch('<?= ROOT ?>/SalonService/delete/' + serviceIDToDelete, {
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
    <!-- <script src="<?=ROOT?>/assets/js/salon/salonpopup.js"></script>  -->
</html>