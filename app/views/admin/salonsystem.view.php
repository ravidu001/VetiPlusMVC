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
                        <tr>
                            <td>Elegance Salon</td>
                            <td>elegance@example.com</td>
                            <td>2023-06-15</td>
                            <td>BR-2023-001</td>
                            <td>
                                <a href="#" class="document-link">
                                    <i class='bx bx-download'></i>View Docs
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">
                                        <i class='bx bx-check'></i>Accept
                                    </button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">
                                        <i class='bx bx-x'></i>Decline
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Elegance Salon</td>
                            <td>elegance@example.com</td>
                            <td>2023-06-15</td>
                            <td>BR-2023-001</td>
                            <td>
                                <a href="#" class="document-link">
                                    <i class='bx bx-download'></i>View Docs
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">
                                        <i class='bx bx-check'></i>Accept
                                    </button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">
                                        <i class='bx bx-x'></i>Decline
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Elegance Salon</td>
                            <td>elegance@example.com</td>
                            <td>2023-06-15</td>
                            <td>BR-2023-001</td>
                            <td>
                                <a href="#" class="document-link">
                                    <i class='bx bx-download'></i>View Docs
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">
                                        <i class='bx bx-check'></i>Accept
                                    </button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">
                                        <i class='bx bx-x'></i>Decline
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Elegance Salon</td>
                            <td>elegance@example.com</td>
                            <td>2023-06-15</td>
                            <td>BR-2023-001</td>
                            <td>
                                <a href="#" class="document-link">
                                    <i class='bx bx-download'></i>View Docs
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">
                                        <i class='bx bx-check'></i>Accept
                                    </button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">
                                        <i class='bx bx-x'></i>Decline
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Elegance Salon</td>
                            <td>elegance@example.com</td>
                            <td>2023-06-15</td>
                            <td>BR-2023-001</td>
                            <td>
                                <a href="#" class="document-link">
                                    <i class='bx bx-download'></i>View Docs
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-accept" onclick="openModal('accept')">
                                        <i class='bx bx-check'></i>Accept
                                    </button>
                                    <button class="btn btn-decline" onclick="openModal('decline')">
                                        <i class='bx bx-x'></i>Decline
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- More table rows can be added similarly -->
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