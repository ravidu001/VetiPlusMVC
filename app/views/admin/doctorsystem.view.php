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
                            <th>Doctor ID</th>
                            <th>Registration Date</th>
                            <th>Medical License</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>emily.johnson@example.com</td>
                            <td>Dr. Emily Johnson</td>
                            <td>2345678</td>
                            <td>2023-06-15</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="../../assets/images/image_10.png" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>michael.smith@example.com</td>
                            <td>Dr. Michael Smith</td>
                            <td>2200456</td>
                            <td>2023-06-10</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="../../assets/images/image_10.png" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>michael.smith@example.com</td>
                            <td>Dr. Michael Smith</td>
                            <td>2200456</td>
                            <td>2023-06-10</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="../../assets/images/image_10.png" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>michael.smith@example.com</td>
                            <td>Dr. Michael Smith</td>
                            <td>2200456</td>
                            <td>2023-06-10</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="../../assets/images/image_10.png" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>michael.smith@example.com</td>
                            <td>Dr. Michael Smith</td>
                            <td>2200456</td>
                            <td>2023-06-10</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="../../assets/images/image_10.png" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>michael.smith@example.com</td>
                            <td>Dr. Michael Smith</td>
                            <td>2200456</td>
                            <td>2023-06-10</td>
                            <td>
                                <a href="#" class="document-link">
                                    <img src="" alt="Download">
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">Accept</button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">Decline</button>
                                </div>
                            </td>
                        </tr>
                        <!-- More rows can be added similarly -->
                    </tbody>
                </table>
            </div>
            <div id="actionModal" class="modal">
                <div class="modal-content">
                    <i class='bx bx-question-mark modal-icon'></i>
                    <h2 id="modalTitle">Confirm Action</h2>
                    <p id="modalDescription">Are you sure you want to proceed?</p>
                    <div class="modal-buttons">
                        <button class="btn btn-accept">Confirm</button>
                        <button class="btn btn-decline" onclick="closeModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/admin/adminsystemaccpet.js"></script>

</body>

</html>