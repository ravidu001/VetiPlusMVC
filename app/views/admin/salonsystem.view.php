<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Salon System | Admin Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/salonsystem.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        <div class="salon-container">
            <div class="salon-header">
                <h1>Salon Registration Requests</h1>
            </div>

            <div class="salon-table">
                <table>
                    <thead>
                        <tr>
                            <th>Salon Name</th>
                            <th>Email</th>
                            <th>Registration Date</th>
                            <th>Business Number</th>
                            <th>Documents</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                         if(is_array($salonItem)):
                             foreach ($salonItem as $data): ?>
                                <?php if ($data->approvedStatus == 'pending'): ?>
                                    <tr>
                                        <td> <?= htmlspecialchars($data->name) ?> </td>
                                        <td> <?= htmlspecialchars($data->salonID) ?> </td>
                                        <td> <?= htmlspecialchars($data->registeredDate) ?> </td>
                                        <td> <?= htmlspecialchars($data->BRNumber) ?> </td>
                                        <td>
                                            <a href="#" class="document-link">
                                                <img src="<?= ROOT ?>/assets/images/Salon/<?= htmlspecialchars($data->BRCertificate) ?>" alt="Download">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-accept" onclick="openModal('accept', '<?= $data->salonID ?>')">Accept</button>
                                                <button class="btn btn-decline" onclick="openModal('decline','<?= $data->salonID ?>')">Decline</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                <?php endif; ?>
    
                            <?php endforeach; ?>
                            <?php endif?>
                    </tbody>
                </table>
            </div>
            <div id="actionModal" class="modal">
                <div class="modal-content">
                    <i class='bx bx-question-mark modal-icon'></i>
                    <h2 id="modalTitle">Confirm Action</h2>
                    <p id="modalDescription">Are you sure you want to proceed?</p>

                    <!-- Reason Input (initially hidden) -->
                    <div id="rejectReasonWrapper" style="display: none; margin-top: 10px;">
                        <label for="rejectReason">Reason for rejection:</label>
                        <input type="text" id="rejectReason" placeholder="Enter reason..." class="reject-input">
                    </div>

                    <div class="modal-buttons">
                        <button class="btn btn-accept" id="confirmButton">Confirm</button>
                        <button class="btn btn-decline" onclick="closeModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('confirmButton').addEventListener('click', () => {
            if (selectedSalonID && selectedActionType) {
                if (selectedActionType === 'decline') {
                    const reason = document.getElementById('rejectReason').value.trim();
                    if (!reason) {
                        alert("Please provide a reason for rejection.");
                        return;
                    }
                    // Pass reason via query string (or POST if needed)
                    window.location.href = `<?= ROOT ?>/AdminSalonSystem/decline/${selectedSalonID}?reason=${encodeURIComponent(reason)}`;
                } else {
                    window.location.href = `<?= ROOT ?>/AdminSalonSystem/accept/${selectedSalonID}`;
                }
            }
        });
    </script>
    <script src="<?= ROOT ?>/assets/js/admin/adminsalonsystemaccepet.js"></script>
</body>

</html>