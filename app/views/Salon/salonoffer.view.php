<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonoffer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<style>
       .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-content p {
            font-size: 16px;
            color: #333;
            margin: 15px 0 25px 0;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: #333;
        }

        .modal-content button {
            padding: 8px 25px;
            margin: 0 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        #confirmDeleteBtn {
            background-color: #6a0dad;
            color: white;
        }

        #confirmDeleteBtn:hover {
            background-color: #6a0dad;
        }

        .modal-content button:nth-child(4) {
            background-color: #eee;
            color: #333;
        }

        .modal-content button:nth-child(4):hover {
            background-color: #ddd;
        }

        @media screen and (max-width: 400px) {
            .modal-content {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
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
                                    <th><?= htmlspecialchars($x['serviceName'] ?? 'No Service Name') ?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 class="discount">Discount</h2>
                                            <h3><?= htmlspecialchars($x['discount']) ?>%</h3>
                                            <h2 class="date">Open Date</h2>
                                            <h3><?= date("d M Y", strtotime($x['startDate'])) ?></h3>
                                            <h2 class="date">Close Date</h2>
                                            <h3><?= date("d M Y", strtotime($x['closeDate'])) ?></h3>
                                            <h2 class="date">Created Date</h2>
                                            <h3><?= date("d M Y", strtotime($x['createDate'])) ?></h3>
                                        </td>
                                        <td>
                                            <p>
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