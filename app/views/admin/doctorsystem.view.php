<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Doctor Registration | Admin Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/doctorsystem.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        <div class="doctor-container">
            <div class="doctor-header">
                <h1>Doctor Registration Requests</h1>
            </div>

            <div class="doctor-table">
                <table>
                    <thead>
                        <tr>
                            <th>Doctor Email</th>
                            <th>Doctor Name</th>
                            <th>Licenese ID</th>
                            <th>Registration Date</th>
                            <th>Medical License</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       if(is_array($doctorItem)):
                         foreach ($doctorItem as $data): ?>

                            <?php if ($data->approvedStatus == 'pending'): ?>
                                <tr>
                                    <td> <?= htmlspecialchars($data->doctorID) ?> </td>
                                    <td> <?= htmlspecialchars($data->fullName) ?> </td>
                                    <td> <?= htmlspecialchars($data->lnumber) ?> </td>
                                    <td> <?= htmlspecialchars($data->registeredDate) ?> </td>
                                    <td>
                                        <a href="#" class="document-link">
                                            <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($data->doctorCertificate) ?>" alt="Download">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-accept" onclick="openModal('accept', '<?= $data->doctorID ?>')">Accept</button>
                                            <button class="btn btn-decline" onclick="openModal('decline','<?= $data->doctorID ?>')">Decline</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <!-- <p> No registration requests </p> -->
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
            if (selectedDoctorID && selectedActionType) {
                if (selectedActionType === 'decline') {
                    const reason = document.getElementById('rejectReason').value.trim();
                    if (!reason) {
                        alert("Please provide a reason for rejection.");
                        return;
                    }
                    // Pass reason via query string (or POST if needed)
                    window.location.href = `<?= ROOT ?>/AdminDoctorSystem/decline/${selectedDoctorID}?reason=${encodeURIComponent(reason)}`;
                } else {
                    window.location.href = `<?= ROOT ?>/AdminDoctorSystem/accept/${selectedDoctorID}`;
                }
            }
        });
    </script>
    <script src="<?= ROOT ?>/assets/js/admin/adminsystemaccpet.js"></script>

</body>

</html>